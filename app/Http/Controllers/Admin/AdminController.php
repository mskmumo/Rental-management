<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard(): View
    {
        // Get statistics for the dashboard
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        $activeUsers = User::where('usertype', 'client')->count();
        
        // Calculate room occupancy rate
        $totalRooms = Room::count();
        $occupiedRooms = Booking::where('status', 'confirmed')
            ->where('check_in_date', '<=', Carbon::now())
            ->where('check_out_date', '>=', Carbon::now())
            ->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

        // Get pending bookings
        $pendingBookings = Booking::with(['user', 'room'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Get recent activities
        $recentActivities = \App\Models\Activity::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Monthly revenue for chart
        $monthlyRevenue = Booking::where('status', 'confirmed')
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalRevenue',
            'activeUsers',
            'occupancyRate',
            'pendingBookings',
            'recentActivities',
            'monthlyRevenue'
        ));
    }
}
