<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();

        // Fetch user's complaints statistics
        $totalReports = Complaint::where('user_id', $userId)->count();
        $processingReports = Complaint::where('user_id', $userId)
            ->whereIn('status', ['pending', 'proses', 'menunggu_validasi'])
            ->count();
        $completedReports = Complaint::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        // Fetch user's recent complaints
        $recentReports = Complaint::where('user_id', $userId)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Fetch public recent complaints for inspiration
        $publicReports = Complaint::with(['user', 'category'])
            ->where('status', '!=', 'ditolak')
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
