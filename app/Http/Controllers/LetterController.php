<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $letters = Letter::where('user_id', $user->id)->latest()->paginate(15);
        return view('user.letters.index' , compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.letters.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Letter::create($data);
        return redirect()->route('user.letters.index')->with('success', 'Letter submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        $this->authorize('view', $letter);
        return view('user.letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        $this->authorize('update', $letter);
        return view('user.letters.form', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        $this->authorize('update', $letter);
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|string',
        ]);

        $letter->update($data);
        return redirect()->route('user.letters.index')->with('success', 'Letter updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        $this->authorize('delete', $letter);
        $letter->delete();
        return back()->with('success', 'Letter deleted.');
    }
}
