<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Household;

class HouseholdController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Resident::class);
        // Use Household model with counts and head relationship
        $perPage = 20;
        $paginator = Household::withCount('residents')->with('head')->orderBy('kk_number')->paginate($perPage);

        // Build representative: prefer head, otherwise first resident
        $collection = $paginator->getCollection()->map(function ($hh) {
            $rep = $hh->head ?? $hh->residents()->orderBy('id')->first();
            return (object)[
                'id' => $hh->id,
                'kk_number' => $hh->kk_number,
                'members' => $hh->residents_count ?? $hh->residents()->count(),
                'representative' => $rep,
                'head_id' => $hh->head_id,
            ];
        });

        $paginator->setCollection($collection);

        return view('admin.households.index', ['households' => $paginator]);
    }

    /**
     * Assign a resident as head of the KK. Ensures only one head per KK.
     */
    public function assignHead(Request $request)
    {
        $this->authorize('update', Resident::class);
        $data = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'kk_number' => 'required|string',
        ]);

        // Unset previous head for that KK
        Resident::where('kk_number', $data['kk_number'])->update(['is_head' => false]);

        // Set new head
        $resident = Resident::findOrFail($data['resident_id']);
        $resident->is_head = true;
        $resident->save();

        return redirect()->back()->with('success', 'Kepala keluarga berhasil ditetapkan.');
    }

    /**
     * Update an entire household's KK number (change the KK number for all members)
     */
    public function updateKk(Request $request)
    {
        $this->authorize('update', Resident::class);
        $data = $request->validate([
            'old_kk' => 'required|string',
            'new_kk' => 'required|string',
        ]);

        // Update all residents with old_kk to new_kk
        Resident::where('kk_number', $data['old_kk'])->update(['kk_number' => $data['new_kk']]);

        return redirect()->route('admin.households.index')->with('success', 'No. KK berhasil diperbarui untuk keluarga.');
    }
}
