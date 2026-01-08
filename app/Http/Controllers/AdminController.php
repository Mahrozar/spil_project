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
use App\Models\News;
use App\Models\Gallery;
use Illuminate\Support\Str;

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
    public function newsIndex(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $query = News::with('author')->latest();

        // Search
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $news = $query->paginate(20)->withQueryString();

        $stats = [
            'total' => News::count(),
            'published' => News::where('is_published', true)->count(),
            'draft' => News::where('is_published', false)->count(),
            'monthly' => News::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        return view('admin.news.index', compact('news', 'stats'));
    }

    /**
     * Show the form for creating a new news.
     */
    public function newsCreate()
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $authors = User::whereIn('role', ['admin', 'petugas'])->get();

        return view('admin.news.create', compact('authors'));
    }

    /**
     * Store a newly created news in storage.
     */
    public function newsStore(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'author_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->only(['title', 'excerpt', 'content', 'published_at', 'is_published', 'author_id']);
            $data['slug'] = Str::slug($request->title);

            // Set default values
            $data['is_published'] = $request->boolean('is_published');
            $data['published_at'] = $data['is_published'] ? ($request->published_at ?? now()) : null;

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('news/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            News::create($data);

            return redirect()->route('admin.news.index')
                ->with('success', 'Berita berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified news.
     */
    public function newsShow(News $news)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified news.
     */
    public function newsEdit(News $news)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $authors = User::whereIn('role', ['admin', 'petugas'])->get();

        return view('admin.news.edit', compact('news', 'authors'));
    }

    /**
     * Update the specified news in storage.
     */
    public function newsUpdate(Request $request, News $news)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'author_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->only(['title', 'excerpt', 'content', 'published_at', 'is_published', 'author_id']);

            // Update slug if title changed
            if ($news->title !== $request->title) {
                $data['slug'] = Str::slug($request->title);
            }

            $data['is_published'] = $request->boolean('is_published');
            if ($data['is_published'] && !$data['published_at']) {
                $data['published_at'] = now();
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                    Storage::disk('public')->delete($news->thumbnail);
                }

                $path = $request->file('thumbnail')->store('news/thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            $news->update($data);

            return redirect()->route('admin.news.index')
                ->with('success', 'Berita berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified news from storage.
     */
    public function newsDestroy(News $news)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        try {
            // Delete thumbnail if exists
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }

            $news->delete();

            return redirect()->route('admin.news.index')
                ->with('success', 'Berita berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete news.
     */
    public function newsBulkDestroy(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.news.index')->with('error', 'Tidak ada berita yang dipilih.');
        }

        try {
            $newsItems = News::whereIn('id', $ids)->get();

            foreach ($newsItems as $news) {
                // Delete thumbnails
                if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                    Storage::disk('public')->delete($news->thumbnail);
                }
            }

            News::whereIn('id', $ids)->delete();

            return redirect()->route('admin.news.index')->with('success', 'Berita yang dipilih berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle publish status.
     */
    public function newsTogglePublish(News $news)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        try {
            $news->update([
                'is_published' => !$news->is_published,
                'published_at' => $news->is_published ? null : now(),
            ]);

            $status = $news->is_published ? 'dipublikasikan' : 'disimpan sebagai draft';
            return redirect()->back()->with('success', "Berita berhasil {$status}.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function galleriesIndex(Request $request) // UBAH NAMA METHOD INI
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $query = Gallery::latest();

        // Search
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(24)->withQueryString();

        $stats = [
            'total' => Gallery::count(),
            'photos' => Gallery::where('type', 'photo')->count(),
            'videos' => Gallery::where('type', 'video')->count(),
            'active' => Gallery::where('is_active', true)->count(),
            'categories' => Gallery::distinct('category')->whereNotNull('category')->pluck('category')->toArray(),
        ];

        return view('admin.galleries.index', compact('galleries', 'stats'));
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function galleryCreate()
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $categories = Gallery::distinct('category')->whereNotNull('category')->pluck('category');

        return view('admin.galleries.create', compact('categories'));
    }

    /**
     * Store a newly created gallery in storage.
     */
    public function galleryStore(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        // Debug: Log request data
        \Log::info('Gallery Store Request:', $request->all());
        \Log::info('Files:', $request->file() ?: []);

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:photo,video',
            'image' => 'required_if:type,photo|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'required_if:type,video|nullable|url',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal: ' . implode(', ', $validator->errors()->all()));
        }

        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'description', 'type', 'video_url', 'category', 'order']);
            $data['is_active'] = $request->boolean('is_active', true);

            // Set default order jika kosong
            if (empty($data['order'])) {
                $data['order'] = 0;
            }

            // Handle image upload for photos
            if ($request->type === 'photo' && $request->hasFile('image')) {
                \Log::info('Processing photo upload');

                // Validasi file image
                if (!$request->file('image')->isValid()) {
                    throw new \Exception('File gambar tidak valid');
                }

                $path = $request->file('image')->store('galleries/photos', 'public');
                $data['image_path'] = $path;
                \Log::info('Image stored at: ' . $path);
            } else if ($request->type === 'photo') {
                // Jika type photo tapi tidak ada file
                throw new \Exception('File gambar diperlukan untuk tipe foto');
            }

            // Untuk video, pastikan video_url ada
            if ($request->type === 'video') {
                if (empty($data['video_url'])) {
                    throw new \Exception('URL video diperlukan untuk tipe video');
                }
                $data['image_path'] = null; // Pastikan image_path null untuk video
            }

            \Log::info('Creating gallery with data:', $data);
            $gallery = Gallery::create($data);
            \Log::info('Gallery created with ID: ' . $gallery->id);

            DB::commit();

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Item galeri berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating gallery: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified gallery.
     */
    public function galleryShow(Gallery $gallery)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        // Get related galleries
        $related = Gallery::where('id', '!=', $gallery->id)
            ->where(function ($query) use ($gallery) {
                $query->where('category', $gallery->category)
                    ->orWhere('type', $gallery->type);
            })
            ->active()
            ->latest()
            ->take(4)
            ->get();

        return view('admin.galleries.show', compact('gallery', 'related'));
    }

    /**
     * Show the form for editing the specified gallery.
     */
    public function galleryEdit(Gallery $gallery)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $categories = Gallery::distinct('category')->whereNotNull('category')->pluck('category');

        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified gallery in storage.
     */
    public function galleryUpdate(Request $request, Gallery $gallery)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:photo,video',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'required_if:type,video|nullable|url',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->only(['title', 'description', 'type', 'video_url', 'category', 'order']);
            $data['is_active'] = $request->boolean('is_active');

            // Handle image upload for photos
            if ($request->type === 'photo' && $request->hasFile('image')) {
                // Delete old image
                if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                    Storage::disk('public')->delete($gallery->image_path);
                }

                $path = $request->file('image')->store('galleries/photos', 'public');
                $data['image_path'] = $path;
            }

            // If changing type from photo to video, remove image
            if ($request->type === 'video' && $gallery->type === 'photo') {
                if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                    Storage::disk('public')->delete($gallery->image_path);
                }
                $data['image_path'] = null;
            }

            $gallery->update($data);

            return redirect()->route('admin.galleries.show', $gallery)
                ->with('success', 'Item galeri berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified gallery from storage.
     */
    public function galleryDestroy(Gallery $gallery)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        try {
            // Delete image if exists
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $gallery->delete();

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Item galeri berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete galleries.
     */
    public function galleriesBulkDestroy(Request $request)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.galleries.index')->with('error', 'Tidak ada item yang dipilih.');
        }

        try {
            $galleries = Gallery::whereIn('id', $ids)->get();

            foreach ($galleries as $gallery) {
                // Delete images
                if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                    Storage::disk('public')->delete($gallery->image_path);
                }
            }

            Gallery::whereIn('id', $ids)->delete();

            return redirect()->route('admin.galleries.index')->with('success', 'Item yang dipilih berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status.
     */
    public function galleryToggleActive(Gallery $gallery)
    {
        $user = auth()->user();
        if (!$user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        try {
            $gallery->update([
                'is_active' => !$gallery->is_active
            ]);

            $status = $gallery->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->back()->with('success', "Item galeri berhasil {$status}.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
