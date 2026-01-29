<?php

namespace App\Http\Controllers;

use App\Models\RW;
use Illuminate\Http\Request;

class RWController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', RW::class);
        $rws = RW::withCount(['rts', 'residents'])
                ->latest()
                ->paginate(10);
        $totalRWs = RW::count();
        return view('admin.rws.index', compact('rws', 'totalRWs'));
    }

    public function create()
    {
        $this->authorize('create', RW::class);
        return view('admin.rws.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', RW::class);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ketua_rw' => 'nullable|string|max:255',
            'no_hp_ketua_rw' => 'nullable|string|max:20',
        ]);
        
        RW::create($data);
        return redirect()->route('admin.rws.index')
            ->with('success', 'RW berhasil ditambahkan.');
    }

    public function show(RW $rw)
    {
        $this->authorize('view', $rw);
        $rw->load(['rts', 'rts.residents']);
        $rw->loadCount(['rts', 'residents']);
        return view('admin.rws.show', compact('rw'));
    }

    public function edit(RW $rw)
    {
        $this->authorize('update', $rw);
        return view('admin.rws.edit', compact('rw'));
    }

    public function update(Request $request, RW $rw)
    {
        $this->authorize('update', $rw);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ketua_rw' => 'nullable|string|max:255',
            'no_hp_ketua_rw' => 'nullable|string|max:20',
        ]);
        
        $rw->update($data);
        return redirect()->route('admin.rws.index')
            ->with('success', 'RW berhasil diperbarui.');
    }

    public function destroy(RW $rw)
    {
        $this->authorize('delete', $rw);
        $rw->delete();
        return redirect()->route('admin.rws.index')
            ->with('success', 'RW berhasil dihapus.');
    }
}