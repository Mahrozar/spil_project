<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterSubmission;
use App\Models\Report;
use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        // Totals (overall)
        $lettersCount = Letter::count();
        $reportsCount = Report::count();
        $residentsTotal = Resident::count();
        $rtTotal = RT::count();
        $rwTotal = RW::count();

        // Compare last 30 days vs previous 30 days for simple percent change
        $now = now();
        $curStart = $now->copy()->subDays(29)->startOfDay();
        $curEnd = $now->copy()->endOfDay();
        $prevStart = $now->copy()->subDays(59)->startOfDay();
        $prevEnd = $now->copy()->subDays(30)->endOfDay();

        $lettersCur = Letter::whereBetween('created_at', [$curStart, $curEnd])->count();
        $lettersPrev = Letter::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $reportsCur = Report::whereBetween('created_at', [$curStart, $curEnd])->count();
        $reportsPrev = Report::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $residentsCur = Resident::whereBetween('created_at', [$curStart, $curEnd])->count();
        $residentsPrev = Resident::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $rtCur = RT::whereBetween('created_at', [$curStart, $curEnd])->count();
        $rtPrev = RT::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $rwCur = RW::whereBetween('created_at', [$curStart, $curEnd])->count();
        $rwPrev = RW::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $percent = function ($cur, $prev) {
            if ($prev <= 0)
                return $cur > 0 ? 100 : 0;
            return round((($cur - $prev) / max(1, $prev)) * 100, 1);
        };

        $kpis = [
            'surat' => ['total' => $lettersCount, 'period' => $lettersCur, 'change' => $percent($lettersCur, $lettersPrev), 'delta' => $lettersCur - $lettersPrev],
            'laporan' => ['total' => $reportsCount, 'period' => $reportsCur, 'change' => $percent($reportsCur, $reportsPrev), 'delta' => $reportsCur - $reportsPrev],
            'penduduk' => ['total' => $residentsTotal, 'period' => $residentsCur, 'change' => $percent($residentsCur, $residentsPrev), 'delta' => $residentsCur - $residentsPrev],
            'rt' => ['total' => $rtTotal, 'period' => $rtCur, 'change' => $percent($rtCur, $rtPrev), 'delta' => $rtCur - $rtPrev],
            'rw' => ['total' => $rwTotal, 'period' => $rwCur, 'change' => $percent($rwCur, $rwPrev), 'delta' => $rwCur - $rwPrev],
        ];

        // Monthly counts for the last 12 months
        $lettersByMonth = Letter::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('count', 'ym')
            ->toArray();

        $reportsByMonth = Report::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('count', 'ym')
            ->toArray();

        // Build a sequence of month keys for the last 12 months
        $months = [];
        $labels = [];
        for ($i = 11; $i >= 0; $i--) {
            $m = now()->subMonths($i)->format('Y-m');
            $months[] = $m;
            $labels[] = now()->subMonths($i)->format('M Y');
        }

        $lettersData = array_map(fn($m) => $lettersByMonth[$m] ?? 0, $months);
        $reportsData = array_map(fn($m) => $reportsByMonth[$m] ?? 0, $months);

        // Recent activity: merge latest entries from letters, reports, residents
        $lettersRecent = Letter::latest()->take(10)->get();
        $reportsRecent = Report::latest()->take(10)->get();
        $residentsRecent = Resident::latest()->take(10)->get();

        $events = [];
        foreach ($lettersRecent as $l) {
            $events[] = [
                'time' => $l->created_at,
                'message' => "Surat (#{$l->id}) dibuat",
                'type' => 'surat',
                'link' => Route::has('admin.submissions.show') ? route('admin.submissions.show', $l) : null,
            ];
        }
        foreach ($reportsRecent as $r) {
            $events[] = [
                'time' => $r->created_at,
                'message' => "Laporan (#{$r->id}) dibuat",
                'type' => 'laporan',
                'link' => Route::has('admin.reports.show') ? route('admin.reports.show', $r) : null,
            ];
        }
        foreach ($residentsRecent as $p) {
            $events[] = [
                'time' => $p->created_at,
                'message' => "Penduduk ditambahkan: {$p->name}",
                'type' => 'penduduk',
                'link' => Route::has('admin.residents.show') ? route('admin.residents.show', $p) : null,
            ];
        }

        // Include recent import summaries stored in storage/app/imports
        try {
            $importFiles = Storage::files('imports');
            rsort($importFiles); // newest first
            $count = 0;
            foreach ($importFiles as $f) {
                if ($count >= 5)
                    break;
                try {
                    $raw = Storage::get($f);
                    $json = json_decode($raw, true);
                    if ($json) {
                        $events[] = [
                            'time' => !empty($json['timestamp']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $json['timestamp']) : now(),
                            'message' => sprintf("Import: %s — Dibuat: %d, Diperbarui: %d, Dilewati: %d", $json['file'] ?? basename($f), $json['created'] ?? 0, $json['updated'] ?? 0, $json['skipped'] ?? 0),
                            'type' => 'import',
                            'link' => Route::has('admin.imports.download') ? route('admin.imports.download', basename($f)) : null,
                        ];
                    }
                } catch (\Exception $e) {
                    // ignore unreadable file
                }
                $count++;
            }
        } catch (\Exception $e) {
            // storage may not be available; ignore
        }

        // sort by time desc and take top 10
        usort($events, function ($a, $b) {
            return $b['time']->getTimestamp() <=> $a['time']->getTimestamp();
        });
        $recentActivities = array_slice($events, 0, 10);

        return view('admin.dashboard', compact(
            'lettersCount',
            'reportsCount',
            'residentsTotal',
            'rtTotal',
            'rwTotal',
            'labels',
            'lettersData',
            'reportsData',
            'kpis',
            'recentActivities'
        ));
    }

    /**
     * Return JSON data for dashboard charts for a given date range.
     * Accepts `from` and `to` as YYYY-MM-DD. If not provided, returns last 12 months.
     */
    public function dashboardData(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // parse from/to or default to last 12 months
        $from = $request->query('from');
        $to = $request->query('to');

        if ($from && $to) {
            try {
                $start = \Carbon\Carbon::createFromFormat('Y-m-d', $from)->startOfMonth();
                $end = \Carbon\Carbon::createFromFormat('Y-m-d', $to)->endOfMonth();
            } catch (\Exception $e) {
                return response()->json(['error' => 'Invalid date format'], 422);
            }
        } else {
            $end = now()->endOfMonth();
            $start = now()->subMonths(11)->startOfMonth();
        }

        // Build months sequence between start and end (inclusive) grouped by month
        $months = [];
        $labels = [];
        $cursor = $start->copy();
        while ($cursor->lte($end)) {
            $key = $cursor->format('Y-m');
            $months[] = $key;
            $labels[] = $cursor->format('M Y');
            $cursor->addMonth();
        }

        $lettersByMonth = Letter::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->whereBetween('created_at', [$start->toDateString(), $end->toDateString()])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('count', 'ym')
            ->toArray();

        $reportsByMonth = Report::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->whereBetween('created_at', [$start->toDateString(), $end->toDateString()])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('count', 'ym')
            ->toArray();

        $lettersData = array_map(fn($m) => $lettersByMonth[$m] ?? 0, $months);
        $reportsData = array_map(fn($m) => $reportsByMonth[$m] ?? 0, $months);

        $lettersCount = Letter::whereBetween('created_at', [$start->toDateString(), $end->toDateString()])->count();
        $reportsCount = Report::whereBetween('created_at', [$start->toDateString(), $end->toDateString()])->count();

        $residentsCount = Resident::whereBetween('created_at', [$start->toDateString(), $end->toDateString()])->count();
        $rtCount = RT::whereBetween('created_at', [$start->toDateString(), $end->toDateString()])->count();
        $rwCount = RW::whereBetween('created_at', [$start->toDateString(), $end->toDateString()])->count();

        return response()->json([
            'labels' => $labels,
            'months' => $months,
            'lettersData' => $lettersData,
            'reportsData' => $reportsData,
            'lettersCount' => $lettersCount,
            'reportsCount' => $reportsCount,
            'residentsCount' => $residentsCount,
            'rtCount' => $rtCount,
            'rwCount' => $rwCount,
        ]);
    }

    public function lettersIndex()
    {
        // Delegate to submissions listing so admin "Surat" shows online submissions
        return $this->submissionsIndex();
    }

    /**
     * List online submissions
     */
    public function submissionsIndex()
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $query = LetterSubmission::latest();
        $q = request('q');
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('submission_number', 'like', "%{$q}%")
                    ->orWhere('nama', 'like', "%{$q}%")
                    ->orWhere('nik', 'like', "%{$q}%")
                    ->orWhere('jenis_surat', 'like', "%{$q}%");
            });
        }

        $submissions = $query->paginate(20)->withQueryString();
        return view('admin.submissions.index', compact('submissions'));
    }

    public function submissionShow(LetterSubmission $submission)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        return view('admin.submissions.show', compact('submission'));
    }

    public function submissionEdit(LetterSubmission $submission)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        return view('admin.submissions.edit', compact('submission'));
    }

    public function submissionUpdate(Request $request, LetterSubmission $submission)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|string|in:pending,approve,on progres,rejected',
        ]);

        $submission->update($data);
        return redirect()->route('admin.submissions.index')->with('success', 'Submission updated.');
    }

    public function submissionDestroy(LetterSubmission $submission)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted.');
    }

    /**
     * Show a single letter details
     */
    public function letterShow($letter)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $submission = LetterSubmission::findOrFail($letter);
        return view('admin.submissions.show', compact('submission'));
    }

    /**
     * Edit letter (admin) - allow status update
     */
    public function letterEdit($letter)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $submission = LetterSubmission::findOrFail($letter);
        return view('admin.submissions.edit', compact('submission'));
    }

    public function letterUpdate(Request $request, $letter)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|string|in:pending,approve,on progres,rejected',
        ]);

        $submission = LetterSubmission::findOrFail($letter);
        $submission->update($data);
        return redirect()->route('admin.submissions.index')->with('success', 'Submission updated.');
    }

    public function letterDestroy($letter)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $submission = LetterSubmission::findOrFail($letter);
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted.');
    }

    /**
     * Bulk delete letters by IDs (expects ids[])
     */
    public function lettersBulkDestroy(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.submissions.index')->with('error', 'No submissions selected.');
        }

        // Delete from LetterSubmission to operate on online submissions
        LetterSubmission::whereIn('id', $ids)->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Selected submissions deleted.');
    }


    public function reportsIndex(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $query = Report::with(['assignedUser', 'photos'])->latest();

        // Apply filters
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('report_code', 'like', "%{$search}%")
                    ->orWhere('reporter_name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('facility_category')) {
            $query->where('facility_category', $request->facility_category);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $reports = $query->paginate(20)->withQueryString();

        // Get filter options for view
        $statuses = Report::getStatusLabels();
        $priorities = Report::getPriorityLabels();
        $facilityCategories = Report::getFacilityCategories();

        // Hitung statistik untuk card
        $stats = [
            'total' => Report::count(),
            'submitted' => Report::where('status', 'submitted')->count(),
            'in_progress' => Report::where('status', 'in_progress')->count(),
            'completed' => Report::where('status', 'completed')->count(),
        ];

        // Hitung statistik distribusi
        $priorityDistribution = [
            'urgent' => Report::where('priority', 'urgent')->count(),
            'high' => Report::where('priority', 'high')->count(),
            'medium' => Report::where('priority', 'medium')->count(),
            'low' => Report::where('priority', 'low')->count(),
        ];

        // Hitung statistik kategori
        $categoryDistribution = [];
        foreach ($facilityCategories as $key => $label) {
            $categoryDistribution[] = [
                'label' => $label,
                'count' => Report::where('facility_category', $key)->count(),
                'color' => $this->getCategoryColor($key)
            ];
        }

        return view('admin.reports.index', compact(
            'reports',
            'statuses',
            'priorities',
            'facilityCategories',
            'stats',
            'priorityDistribution',
            'categoryDistribution'
        ));
    }

    /**
     * Helper method untuk warna kategori
     */
    private function getCategoryColor($categoryKey)
    {
        $colors = [
            'jalan_jembatan' => 'bg-blue-500',
            'penerangan_umum' => 'bg-green-500',
            'fasilitas_air' => 'bg-purple-500',
            'fasilitas_publik' => 'bg-yellow-500',
            'fasilitas_kesehatan' => 'bg-indigo-500',
            'fasilitas_pendidikan' => 'bg-pink-500',
            'lainnya' => 'bg-gray-500',
        ];

        return $colors[$categoryKey] ?? 'bg-gray-500';
    }

    /**
     * Display the specified report.
     */
    public function reportShow(Report $report)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $admin = User::where('role', 'admin')
            ->get();

        return view('admin.reports.show', compact('report', 'admin'));
    }

    /**
     * Show the form for editing the specified report.
     */
    public function reportEdit(Report $report)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $petugas = User::where('role', 'petugas')
            ->orWhere('role', 'admin')
            ->get();
        $statuses = Report::getStatusLabels();
        $priorities = Report::getPriorityLabels();
        $facilityCategories = Report::getFacilityCategories();

        return view('admin.reports.edit', compact(
            'report',
            'petugas',
            'statuses',
            'priorities',
            'facilityCategories'
        ));
    }

    /**
     * Update the specified report.
     */
    public function reportUpdate(Request $request, Report $report)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:' . implode(',', array_keys(Report::getStatusLabels())),
            'priority' => 'required|in:' . implode(',', array_keys(Report::getPriorityLabels())),
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
            'status_notes' => 'nullable|string|max:500',
            'is_public' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Update report
            $oldStatus = $report->status;
            $oldAssignee = $report->assigned_to;

            $report->update([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'assigned_to' => $request->assigned_to,
                'due_date' => $request->due_date,
                'is_public' => $request->is_public ?? $report->is_public,
            ]);

            // Update status if changed
            if ($request->status !== $oldStatus) {
                $report->changeStatus(
                    $request->status,
                    auth()->id(),
                    $request->status_notes
                );
            }

            // Handle assignment change
            if ($request->assigned_to != $oldAssignee) {
                if ($request->assigned_to) {
                    $report->assignTo($request->assigned_to, $request->due_date);
                } elseif ($oldAssignee) {
                    // Remove assignment
                    $oldUser = User::find($oldAssignee);
                    if ($oldUser) {
                        $oldUser->decrement('pending_reports_count');
                        $oldUser->decrement('assigned_reports_count');
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.reports.index')
                ->with('success', 'Laporan berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified report.
     */
    public function reportDestroy(Report $report)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Add comment to report.
     */
    public function reportAddComment(Request $request, Report $report)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $validator = \Validator::make($request->all(), [
            'comment' => 'required|string|max:500',
            'is_internal' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Models\ReportComment::create([
            'report_id' => $report->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'is_internal' => $request->is_internal ?? false,
        ]);

        return redirect()->back()
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Export reports to Excel/CSV.
     */
    public function reportsExport(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $reports = Report::query();

        // Apply filters if any
        if ($request->filled('date_from')) {
            $reports->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $reports->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $reports->where('status', $request->status);
        }

        $reports = $reports->get();

        // Generate CSV
        $filename = 'laporan-fasilitas-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($reports) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, [
                'Kode Laporan',
                'Jenis Fasilitas',
                'Lokasi (Lat,Long)',
                'Alamat',
                'Pelapor',
                'Status',
                'Prioritas',
                'Ditugaskan ke',
                'Tanggal Lapor',
                'Deskripsi',
            ]);

            // Data
            foreach ($reports as $report) {
                fputcsv($file, [
                    $report->report_code,
                    $report->facility_label,
                    $report->latitude . ', ' . $report->longitude,
                    $report->address,
                    $report->reporter_name ?: 'Anonim',
                    $report->status_label,
                    $report->priority_label,
                    $report->assignedUser ? $report->assignedUser->name : '-',
                    $report->created_at->format('d/m/Y H:i'),
                    $report->description,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get reports statistics for dashboard.
     */
    public function reportsStatistics()
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        // Monthly statistics
        $monthlyStats = Report::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed'),
            DB::raw('SUM(CASE WHEN status = "in_progress" THEN 1 ELSE 0 END) as in_progress')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Category statistics
        $categoryStats = Report::select(
            'facility_category',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('facility_category')
            ->get();

        return response()->json([
            'monthly_stats' => $monthlyStats,
            'category_stats' => $categoryStats,
        ]);
    }
}
