<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // sample counts
        $counts = [
            'users' => \App\Models\User::count(),
            'letters' => \App\Models\Letter::count(),
            'reports' => \App\Models\Report::count(),
        ];

        return view('dashboard.index', compact('counts'));
    }
}
