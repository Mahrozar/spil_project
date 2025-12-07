<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Report;
use App\Models\Resident;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'user') !== 'admin') {
            abort(403);
        }

        // Totals (overall)
        $lettersCount = Letter::count();
        $reportsCount = Report::count();
        $residentsTotal = Resident::count();
        $rtTotal = RT::count();
        $rwTotal = RW::count();

        // Compare last 30 days vs previous 30 days for simple percent change
        $now = now();
        $curStart = $now->copy()->subDays(29)->startOfDay();
        $curEnd = $now->copy()->endOfDay();
        $prevStart = $now->copy()->subDays(59)->startOfDay();
        $prevEnd = $now->copy()->subDays(30)->endOfDay();

        $lettersCur = Letter::whereBetween('created_at', [$curStart, $curEnd])->count();
        $lettersPrev = Letter::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $reportsCur = Report::whereBetween('created_at', [$curStart, $curEnd])->count();
        $reportsPrev = Report::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $residentsCur = Resident::whereBetween('created_at', [$curStart, $curEnd])->count();
        $residentsPrev = Resident::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $rtCur = RT::whereBetween('created_at', [$curStart, $curEnd])->count();
        $rtPrev = RT::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $rwCur = RW::whereBetween('created_at', [$curStart, $curEnd])->count();
        $rwPrev = RW::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        $percent = function($cur, $prev) {
            if ($prev <= 0) return $cur > 0 ? 100 : 0;
            return round((($cur - $prev) / max(1, $prev)) * 100, 1);
        };

        $kpis = [
            'surat' => ['total' => $lettersCount, 'period' => $lettersCur, 'change' => $percent($lettersCur, $lettersPrev), 'delta' => $lettersCur - $lettersPrev],
            'laporan' => ['total' => $reportsCount, 'period' => $reportsCur, 'change' => $percent($reportsCur, $reportsPrev), 'delta' => $reportsCur - $reportsPrev],
            'penduduk' => ['total' => $residentsTotal, 'period' => $residentsCur, 'change' => $percent($residentsCur, $residentsPrev), 'delta' => $residentsCur - $residentsPrev],
            'rt' => ['total' => $rtTotal, 'period' => $rtCur, 'change' => $percent($rtCur, $rtPrev), 'delta' => $rtCur - $rtPrev],
            'rw' => ['total' => $rwTotal, 'period' => $rwCur, 'change' => $percent($rwCur, $rwPrev), 'delta' => $rwCur - $rwPrev],
        ];

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

        // Recent activity: merge latest entries from letters, reports, residents
        $lettersRecent = Letter::latest()->take(10)->get();
        $reportsRecent = Report::latest()->take(10)->get();
        $residentsRecent = Resident::latest()->take(10)->get();

        $events = [];
        foreach ($lettersRecent as $l) {
            $events[] = [
                'time' => $l->created_at,
                'message' => "Surat (#{$l->id}) dibuat",
                'type' => 'surat',
                'link' => Route::has('admin.letters.show') ? route('admin.letters.show', $l) : null,
            ];
        }
        foreach ($reportsRecent as $r) {
            $events[] = [
                'time' => $r->created_at,
                'message' => "Laporan (#{$r->id}) dibuat",
                'type' => 'laporan',
                'link' => Route::has('admin.reports.show') ? route('admin.reports.show', $r) : null,
            ];
        }
        foreach ($residentsRecent as $p) {
            $events[] = [
                'time' => $p->created_at,
                'message' => "Penduduk ditambahkan: {$p->name}",
                'type' => 'penduduk',
                'link' => Route::has('admin.residents.show') ? route('admin.residents.show', $p) : null,
            ];
        }

        // Include recent import summaries stored in storage/app/imports
        try {
            $importFiles = Storage::files('imports');
            rsort($importFiles); // newest first
            $count = 0;
            foreach ($importFiles as $f) {
                if ($count >= 5) break;
                try {
                    $raw = Storage::get($f);
                    $json = json_decode($raw, true);
                    if ($json) {
                        $events[] = [
                            'time' => !empty($json['timestamp']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $json['timestamp']) : now(),
                            'message' => sprintf("Import: %s — Dibuat: %d, Diperbarui: %d, Dilewati: %d", $json['file'] ?? basename($f), $json['created'] ?? 0, $json['updated'] ?? 0, $json['skipped'] ?? 0),
                            'type' => 'import',
                            'link' => Route::has('admin.imports.download') ? route('admin.imports.download', basename($f)) : null,
                        ];
                    }
                } catch (\Exception $e) {
                    // ignore unreadable file
                }
                $count++;
            }
        } catch (\Exception $e) {
            // storage may not be available; ignore
        }

        // sort by time desc and take top 10
        usort($events, function($a, $b){
            return $b['time']->getTimestamp() <=> $a['time']->getTimestamp();
        });
        $recentActivities = array_slice($events, 0, 10);

        return view('admin.dashboard', compact(
            'lettersCount',
            'reportsCount',
            'residentsTotal',
            'rtTotal',
            'rwTotal',
            'labels',
            'lettersData',
            'reportsData',
            'kpis',
            'recentActivities'
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
