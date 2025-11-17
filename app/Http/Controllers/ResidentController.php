<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Resident::class);
        $q = request('q');
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
}
