<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportPhoto;
use App\Models\ReportComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of reports (Admin).
     */
    public function index(Request $request)
    {
        // Check if user can manage reports
        if (!auth()->user()->canManageReports()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }

        $query = Report::with(['assignedUser', 'photos']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('facility_category')) {
            $query->where('facility_category', $request->facility_category);
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('report_code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('reporter_name', 'like', "%{$search}%");
            });
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Order by
        $orderBy = $request->get('order_by', 'created_at');
        $orderDirection = $request->get('order_direction', 'desc');
        $query->orderBy($orderBy, $orderDirection);

        $reports = $query->paginate(20)->withQueryString();

        // Get filter options
        $petugas = User::petugas()->get();
        $statuses = Report::getStatusLabels();
        $priorities = Report::getPriorityLabels();
        $facilityCategories = Report::getFacilityCategories();

        // Statistics
        $stats = [
            'total' => Report::count(),
            'submitted' => Report::where('status', 'submitted')->count(),
            'in_progress' => Report::where('status', 'in_progress')->count(),
            'completed' => Report::where('status', 'completed')->count(),
            'overdue' => Report::overdue()->count(),
        ];

        return view('admin.reports.index', compact(
            'reports',
            'petugas',
            'statuses',
            'priorities',
            'facilityCategories',
            'stats'
        ));
    }

    /**
     * Show the form for creating a new report (Public).
     */
    public function create()
    {
        $facilityCategories = Report::getFacilityCategories();
        $facilityTypes = Report::getFacilityTypes();

        return view('reports.create', compact('facilityCategories', 'facilityTypes'));
    }

    /**
     * Store a newly created report (Public).
     */
    public function store(Request $request)
    {
        // Cek jika request adalah AJAX
        $isAjax = $request->ajax() || $request->wantsJson() || $request->expectsJson();

        $validator = Validator::make($request->all(), [
            'facility_category' => 'required|in:' . implode(',', array_keys(Report::getFacilityCategories())),
            'facility_type' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string|max:1000',
            'reporter_name' => 'nullable|string|max:100',
            'reporter_phone' => 'nullable|string|max:20',
            'reporter_email' => 'nullable|email|max:100',
            'photos' => 'nullable|array|max:3',
            'photos.*' => 'image|max:2048', // 2MB max
            'is_anonymous' => 'boolean',
        ]);

        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Create report
            $report = Report::create([
                'report_code' => Report::generateReportCode(),
                'facility_category' => $request->facility_category,
                'facility_type' => $request->facility_type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'reporter_name' => $request->is_anonymous ? null : $request->reporter_name,
                'reporter_phone' => $request->is_anonymous ? null : $request->reporter_phone,
                'reporter_email' => $request->is_anonymous ? null : $request->reporter_email,
                'is_anonymous' => $request->is_anonymous ?? false,
                'status' => Report::STATUS_SUBMITTED,
                'priority' => $this->determinePriority($request->facility_type),
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            // Upload photos
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
                    $path = $photo->store('reports/photos', 'public');

                    ReportPhoto::create([
                        'report_id' => $report->id,
                        'photo_path' => $path,
                        'order' => $index,
                        'is_before' => true,
                    ]);
                }
            }

            // Create initial status history
            $report->statusHistory()->create([
                'old_status' => null,
                'new_status' => Report::STATUS_SUBMITTED,
                'notes' => 'Laporan dibuat oleh masyarakat',
            ]);

            DB::commit();

            // HAPUS dd("test") - ini yang menyebabkan masalah!
            // dd("test");

            // Response berdasarkan tipe request
            if ($isAjax) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil dibuat! Kode laporan: ' . $report->report_code,
                    'report_code' => $report->report_code,
                    'redirect' => route('reports.show', $report->report_code)
                ]);
            }

            return redirect()->route('reports.show', $report->report_code)
                ->with('success', 'Laporan berhasil dibuat. Kode laporan: ' . $report->report_code);

        } catch (\Exception $e) {
            DB::rollBack();

            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified report (Public).
     */
    public function show($code)
    {
        $report = Report::where('report_code', $code)->firstOrFail();

        // Only show public reports or reports where user is authorized
        if (!$report->is_public && !auth()->check()) {
            abort(404);
        }

        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified report (Admin).
     */
    public function edit(Report $report)
    {
        if (!auth()->user()->canManageReports()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }

        $petugas = User::petugas()->get();
        $statuses = Report::getStatusLabels();
        $priorities = Report::getPriorityLabels();
        $facilityCategories = Report::getFacilityCategories();
        $facilityTypes = Report::getFacilityTypes();

        return view('admin.reports.edit', compact(
            'report',
            'petugas',
            'statuses',
            'priorities',
            'facilityCategories',
            'facilityTypes'
        ));
    }

    /**
     * Update the specified report (Admin).
     */
    public function update(Request $request, Report $report)
    {
        if (!auth()->user()->canManageReports()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }

        $validator = Validator::make($request->all(), [
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
     * Remove the specified report (Admin).
     */
    public function destroy(Report $report)
    {
        if (!auth()->user()->canManageReports()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }

        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Add comment to report.
     */
    public function addComment(Request $request, Report $report)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:500',
            'is_internal' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ReportComment::create([
            'report_id' => $report->id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'comment' => $request->comment,
            'is_internal' => $request->is_internal ?? false,
            'commenter_name' => auth()->check() ? null : $request->commenter_name,
            'commenter_role' => auth()->check() ? null : 'masyarakat',
        ]);

        return redirect()->back()
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Upload additional photos to report.
     */
    public function uploadPhotos(Request $request, Report $report)
    {
        if (!auth()->user()->canManageReports()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'photos' => 'required|array|max:5',
            'photos.*' => 'image|max:2048',
            'is_before' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $photos = [];
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('reports/photos', 'public');

            $reportPhoto = ReportPhoto::create([
                'report_id' => $report->id,
                'photo_path' => $path,
                'is_before' => $request->is_before ?? true,
            ]);

            $photos[] = $reportPhoto;
        }

        return response()->json([
            'success' => true,
            'photos' => $photos,
        ]);
    }

    /**
     * Determine priority based on facility type.
     */
    private function determinePriority($facilityType)
    {
        $urgentTypes = ['jalan_berlubang', 'jembatan_rusak', 'pipa_bocor'];
        $highTypes = ['jalan_rusak', 'lampu_jalan_mati', 'drainase_tersumbat'];

        if (in_array($facilityType, $urgentTypes)) {
            return Report::PRIORITY_URGENT;
        }

        if (in_array($facilityType, $highTypes)) {
            return Report::PRIORITY_HIGH;
        }

        return Report::PRIORITY_MEDIUM;
    }

    /**
     * Get reports statistics for dashboard.
     */
    public function statistics()
    {
        if (!auth()->user()->canManageReports()) {
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

        // Petugas performance
        $petugasStats = User::petugas()
            ->withCount(['assignedReports', 'completedReports', 'pendingReports'])
            ->having('assigned_reports_count', '>', 0)
            ->get();

        return response()->json([
            'monthly_stats' => $monthlyStats,
            'category_stats' => $categoryStats,
            'petugas_stats' => $petugasStats,
        ]);
    }

    /**
     * Export reports to Excel.
     */
    public function export(Request $request)
    {
        if (!auth()->user()->canManageReports()) {
            abort(403);
        }

        $reports = Report::query();

        // Apply filters
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
}