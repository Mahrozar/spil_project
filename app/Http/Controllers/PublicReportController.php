<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class PublicReportController extends Controller
{
    /**
     * Show form for creating report.
     */
    public function create()
    {
        $facilityCategories = Report::getFacilityCategories();
        $facilityTypes = Report::getFacilityTypes();
        
        return view('public.reports.create', compact('facilityCategories', 'facilityTypes'));
    }

    /**
     * Show report status.
     */
    public function show($code)
    {
        $report = Report::where('report_code', $code)->firstOrFail();
        
        if (!$report->is_public) {
            abort(404);
        }

        return view('public.reports.show', compact('report'));
    }

    /**
     * Check report status.
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'report_code' => 'required|string',
        ]);

        $report = Report::where('report_code', $request->report_code)->first();

        if (!$report) {
            return redirect()->back()
                ->with('error', 'Kode laporan tidak ditemukan.')
                ->withInput();
        }

        return view('public.reports.show', compact('report'));
    }

    /**
     * Show public reports list (optional).
     */
    public function index()
    {
        $reports = Report::public()
            ->whereIn('status', ['completed', 'closed'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.reports.index', compact('reports'));
    }
}