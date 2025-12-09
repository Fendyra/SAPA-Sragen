<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = auth()->id();

        // Fetch user's reports statistics
        $totalReports = Report::where('user_id', $userId)->count();
        $processingReports = Report::where('user_id', $userId)
            ->whereIn('status', ['pending', 'verified', 'processing'])
            ->count();
        $completedReports = Report::where('user_id', $userId)
            ->whereIn('status', ['resolved', 'completed'])
            ->count();

        // Fetch user's recent reports
        $recentReports = Report::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Fetch public recent reports for inspiration
        $publicReports = Report::where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('dashboard.index', compact(
            'totalReports',
            'processingReports',
            'completedReports',
            'recentReports',
            'publicReports'
        ));
    }
}
