<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        // Get total bookings
        $totalBookings = Booking::count();

        // Get total revenue from confirmed bookings
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // Get active users (clients who have made bookings)
        $activeUsers = User::where('usertype', 'client')
            ->whereHas('bookings')
            ->count();

        // Calculate average occupancy rate
        $totalRooms = Room::count();
        $occupiedRooms = Booking::where('status', 'confirmed')
            ->where('check_in_date', '<=', Carbon::now())
            ->where('check_out_date', '>=', Carbon::now())
            ->count();
        $averageOccupancy = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 1) : 0;

        return view('admin.reports.index', compact(
            'totalBookings',
            'totalRevenue',
            'activeUsers',
            'averageOccupancy'
        ));
    }

    public function bookings(Request $request)
    {
        $data = $this->reportService->getBookingReportData(
            $request->input('start_date'),
            $request->input('end_date'),
            $request->input('status')
        );

        return view('admin.reports.bookings', $data);
    }

    public function revenue()
    {
        $data = $this->reportService->getRevenueReportData();
        return view('admin.reports.revenue', $data);
    }

    public function occupancy()
    {
        $data = $this->reportService->getOccupancyReportData();
        return view('admin.reports.occupancy', $data);
    }
} 