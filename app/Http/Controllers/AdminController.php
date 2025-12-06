<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Report;
use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $lettersCount = Letter::count();
        $reportsCount = Report::count();

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

        return view('admin.dashboard', compact(
            'lettersCount',
            'reportsCount',
            'labels',
            'lettersData',
            'reportsData'
        ));
    }

    /**
     * Return JSON data for dashboard charts for a given date range.
     * Accepts `from` and `to` as YYYY-MM-DD. If not provided, returns last 12 months.
     */
    public function dashboardData(Request $request)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
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
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $query = Letter::with('user')->latest();

        // search by q: matches id, type, status, user name or email
        $q = request('q');
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('id', $q)
                    ->orWhere('type', 'like', "%{$q}%")
                    ->orWhere('status', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                    });
            });
        }

        $letters = $query->paginate(20)->withQueryString();
        return view('admin.letters.index', compact('letters'));
    }

    /**
     * Show a single letter details
     */
    public function letterShow(Letter $letter)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $letter->load('user');
        return view('admin.letters.show', compact('letter'));
    }

    /**
     * Edit letter (admin) - allow status update
     */
    public function letterEdit(Letter $letter)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        return view('admin.letters.edit', compact('letter'));
    }

    public function letterUpdate(Request $request, Letter $letter)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $letter->update($data);
        return redirect()->route('admin.letters')->with('success', 'Letter updated.');
    }

    public function letterDestroy(Letter $letter)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $letter->delete();
        return redirect()->route('admin.letters')->with('success', 'Letter deleted.');
    }

    /**
     * Bulk delete letters by IDs (expects ids[])
     */
    public function lettersBulkDestroy(Request $request)
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $ids = $request->input('ids', []);
        if (! is_array($ids) || empty($ids)) {
            return redirect()->route('admin.letters')->with('error', 'No letters selected.');
        }

        Letter::whereIn('id', $ids)->delete();
        return redirect()->route('admin.letters')->with('success', 'Selected letters deleted.');
    }

    public function reportsIndex()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        $reports = Report::with('user')->latest()->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }
}
