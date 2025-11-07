<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $reports = Report::where('user_id', $user->id)->latest()->paginate(15);
        return view('user.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.reports.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:4096',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reports', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Report::create($data);
        return redirect()->route('user.reports.index')->with('success', 'Report submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return view('user.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        return view('user.reports.form', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:4096',
            'location' => 'nullable|string|max:255',
            'status' => 'sometimes|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('reports', 'public');
        }

        $report->update($data);
        return redirect()->route('user.reports.index')->with('success', 'Report updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();
        return back()->with('success', 'Report deleted.');
    }
}
