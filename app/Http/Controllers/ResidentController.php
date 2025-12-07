<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ResidentsImport;
use App\Exports\ResidentsExport;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Resident::class);

        $q = $request->query('q');
        $filter = $request->query('filter');
        $kkNumber = $request->query('kk_number');

        // If viewing members of a specific Kartu Keluarga (KK)
        if ($filter === 'kk' && $kkNumber) {
            $query = Resident::with(['rt', 'rw'])
                ->where('kk_number', $kkNumber)
                ->orderBy('name');

            if ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('nik', 'like', "%{$q}%");
                });
            }

            $residents = $query->paginate(25)->withQueryString();
            return view('admin.residents.index', compact('residents', 'kkNumber'));
        }

        // Default residents listing
        $query = Resident::with(['rt', 'rw'])->latest();
        if ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('nik', 'like', "%{$q}%")
                  ->orWhere('kk_number', 'like', "%{$q}%");
        }
        $residents = $query->paginate(25)->withQueryString();
        return view('admin.residents.index', compact('residents'));
    }

    public function create()
    {
        $this->authorize('create', Resident::class);
        $rws = RW::orderBy('name')->get();
        $rts = RT::orderBy('name')->get();
        return view('admin.residents.create', compact('rws', 'rts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Resident::class);
        $data = $request->validate([
            'nik' => 'nullable|string|max:32|unique:residents,nik',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'kk_number' => 'nullable|string',
            'rt_id' => 'nullable|exists:rts,id',
            'rw_id' => 'nullable|exists:rws,id',
            'occupation' => 'nullable|string',
            'education' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Resident::create($data);
        return redirect()->route('admin.residents.index')->with('success', 'Resident created.');
    }

    public function show(Resident $resident)
    {
        $this->authorize('view', $resident);
        $resident->load(['rt', 'rw']);
        return view('admin.residents.show', compact('resident'));
    }

    public function edit(Resident $resident)
    {
        $this->authorize('update', $resident);
        $rws = RW::orderBy('name')->get();
        $rts = RT::orderBy('name')->get();
        return view('admin.residents.edit', compact('resident', 'rws', 'rts'));
    }

    public function update(Request $request, Resident $resident)
    {
        $this->authorize('update', $resident);
        $data = $request->validate([
            'nik' => 'nullable|string|max:32|unique:residents,nik,' . $resident->id,
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'kk_number' => 'nullable|string',
            'rt_id' => 'nullable|exists:rts,id',
            'rw_id' => 'nullable|exists:rws,id',
            'occupation' => 'nullable|string',
            'education' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $resident->update($data);
        return redirect()->route('admin.residents.index')->with('success', 'Resident updated.');
    }

    public function destroy(Resident $resident)
    {
        $this->authorize('delete', $resident);
        $resident->delete();
        return redirect()->route('admin.residents.index')->with('success', 'Resident deleted.');
    }

    /**
     * Import residents from uploaded CSV/XLSX
     */
    public function import(Request $request)
    {
        $this->authorize('create', Resident::class);
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        // Use maatwebsite/excel import and collect summary from importer
        $import = new ResidentsImport();
        Excel::import($import, $request->file('file'));

        $msg = sprintf("Import selesai. Dibuat: %d, Diperbarui: %d, Dilewati: %d", $import->created, $import->updated, $import->skipped);

        // Save a JSON summary file for audit in storage/app/imports
        try {
            $summary = [
                'user_id' => auth()->id(),
                'file' => $request->file('file')->getClientOriginalName(),
                'created' => $import->created,
                'updated' => $import->updated,
                'skipped' => $import->skipped,
                'timestamp' => now()->toDateTimeString(),
            ];
            $filename = 'imports/import-' . now()->format('Ymd-His') . '.json';
            Storage::put($filename, json_encode($summary, JSON_PRETTY_PRINT));
            Log::info('Residents import completed', $summary);
        } catch (\Exception $e) {
            Log::error('Failed to write import summary: ' . $e->getMessage());
        }

        // Flash a persistent import_summary and a brief success message
        return redirect()->route('admin.residents.index')->with([
            'success' => $msg,
            'import_summary' => $summary ?? null,
        ]);
    }

    /**
     * Export residents to XLSX
     */
    public function export()
    {
        $this->authorize('viewAny', Resident::class);
        return Excel::download(new ResidentsExport, 'residents.xlsx');
    }

    /**
     * Show list of import summary files (storage/app/imports)
     */
    public function importsIndex()
    {
        $this->authorize('viewAny', Resident::class);

        $files = Storage::files('imports');
        // Build list of summaries
        $summaries = [];
        foreach ($files as $f) {
            try {
                $content = Storage::get($f);
                $json = json_decode($content, true);
            } catch (\Exception $e) {
                $json = null;
            }
            $summaries[] = [
                'path' => $f,
                'file' => basename($f),
                'summary' => $json,
                'timestamp' => Storage::lastModified($f),
            ];
        }

        // sort by timestamp desc
        usort($summaries, fn($a,$b) => $b['timestamp'] <=> $a['timestamp']);

        return view('admin.imports.index', compact('summaries'));
    }

    /**
     * Download a specific import summary JSON file
     */
    public function downloadImport($file)
    {
        $this->authorize('viewAny', Resident::class);
        $safe = basename($file);
        $path = 'imports/' . $safe;
        if (! Storage::exists($path)) {
            abort(404);
        }
        return Storage::download($path);
    }
}
