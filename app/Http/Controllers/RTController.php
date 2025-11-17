<?php

namespace App\Http\Controllers;

use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', RT::class);
        $rts = RT::with('rw')->latest()->paginate(20);
        return view('admin.rts.index', compact('rts'));
    }

    public function create()
    {
        $this->authorize('create', RT::class);
        $rws = RW::orderBy('name')->get();
        return view('admin.rts.create', compact('rws'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', RT::class);
        $data = $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'name' => 'required|string|max:255',
            'leader_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);
        RT::create($data);
        return redirect()->route('admin.rts.index')->with('success', 'RT created.');
    }

    public function show(RT $rt)
    {
        $this->authorize('view', $rt);
        $rt->load('residents');
        return view('admin.rts.show', compact('rt'));
    }

    public function edit(RT $rt)
    {
        $this->authorize('update', $rt);
        $rws = RW::orderBy('name')->get();
        return view('admin.rts.edit', compact('rt', 'rws'));
    }

    public function update(Request $request, RT $rt)
    {
        $this->authorize('update', $rt);
        $data = $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'name' => 'required|string|max:255',
            'leader_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);
        $rt->update($data);
        return redirect()->route('admin.rts.index')->with('success', 'RT updated.');
    }

    public function destroy(RT $rt)
    {
        $this->authorize('delete', $rt);
        $rt->delete();
        return redirect()->route('admin.rts.index')->with('success', 'RT deleted.');
    }
}
