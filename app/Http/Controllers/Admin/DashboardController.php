<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $stats = [
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'total_bookings' => Booking::count(),
            'total_clients' => User::where('usertype', 'client')->count(),
            'revenue_today' => Payment::whereDate('created_at', Carbon::today())
                ->where('status', 'completed')
                ->sum('amount'),
            'revenue_month' => Payment::whereMonth('created_at', Carbon::now()->month)
                ->where('status', 'completed')
                ->sum('amount'),
        ];

        // Get monthly revenue for chart
        $monthlyRevenue = Payment::where('status', 'completed')
            ->whereYear('created_at', Carbon::now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Get recent bookings
        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'monthlyRevenue', 'recentBookings'));
    }
} 