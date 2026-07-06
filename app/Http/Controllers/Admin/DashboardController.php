<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dua;
use App\Models\Niyat;
use App\Models\ChaddarCalculation;
use App\Models\MeeqatDistanceLog;
use App\Models\ActivityLog;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_users'          => User::count(),
            'new_users_today'      => User::whereDate('created_at', today())->count(),
            'total_duas'           => Dua::count(),
            'total_niyat'          => Niyat::count(),
            'chaddar_calculations' => ChaddarCalculation::count(),
            'meeqat_searches'      => MeeqatDistanceLog::count(),
            'searches_today'       => MeeqatDistanceLog::whereDate('created_at', today())->count(),
            'calcs_today'          => ChaddarCalculation::whereDate('created_at', today())->count(),
        ];

        // Recent activity
        $recentActivity = ActivityLog::with('user')
            ->latest('created_at')
            ->take(10)
            ->get();

        // Recent users
        $recentUsers = User::with('role')
            ->latest()
            ->take(5)
            ->get();

        // Weekly stats (last 7 days)
        $weeklyCalcs = [];
        $weeklySearches = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $weeklyCalcs[]    = ChaddarCalculation::whereDate('created_at', $date)->count();
            $weeklySearches[] = MeeqatDistanceLog::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact('stats', 'recentActivity', 'recentUsers', 'weeklyCalcs', 'weeklySearches'));
    }
}