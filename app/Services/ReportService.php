<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getBookingReportData($startDate = null, $endDate = null, $status = null)
    {
        $query = Booking::with(['user', 'room'])
            ->when($startDate, function ($q) use ($startDate) {
                return $q->where('check_in_date', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
                return $q->where('check_out_date', '<=', $endDate);
            })
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            });

        $bookings = $query->latest()->paginate(10);
        $totalBookings = $query->count();
        $totalRevenue = $query->sum('total_price');

        return [
            'bookings' => $bookings,
            'totalBookings' => $totalBookings,
            'totalRevenue' => $totalRevenue
        ];
    }

    public function getRevenueReportData()
    {
        $yearStart = Carbon::now()->startOfYear();
        $yearEnd = Carbon::now()->endOfYear();

        $monthlyRevenue = Booking::where('status', 'confirmed')
            ->whereBetween('check_in_date', [$yearStart, $yearEnd])
            ->select(
                DB::raw('MONTH(check_in_date) as month'),
                DB::raw('COUNT(*) as bookings'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($data) {
                return [
                    'month' => Carbon::create()->month($data->month)->format('F'),
                    'bookings' => $data->bookings,
                    'revenue' => $data->revenue
                ];
            });

        $yearlyRevenue = $monthlyRevenue->sum('revenue');

        return [
            'monthlyRevenue' => $monthlyRevenue,
            'yearlyRevenue' => $yearlyRevenue
        ];
    }

    public function getOccupancyReportData()
    {
        $totalRooms = Room::count();
        $now = Carbon::now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();

        // Calculate current occupancy rate
        $currentlyOccupied = Booking::where('status', 'confirmed')
            ->where('check_in_date', '<=', $now)
            ->where('check_out_date', '>=', $now)
            ->count();

        $currentOccupancyRate = $totalRooms > 0 ? ($currentlyOccupied / $totalRooms) * 100 : 0;

        // Calculate monthly occupancy data
        $monthlyOccupancy = collect();
        $yearStart = Carbon::now()->startOfYear();
        
        for ($month = 1; $month <= 12; $month++) {
            $start = $yearStart->copy()->addMonths($month - 1)->startOfMonth();
            $end = $start->copy()->endOfMonth();
            $daysInMonth = $start->daysInMonth;
            
            $occupiedNights = Booking::where('status', 'confirmed')
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('check_in_date', [$start, $end])
                        ->orWhereBetween('check_out_date', [$start, $end])
                        ->orWhere(function ($q) use ($start, $end) {
                            $q->where('check_in_date', '<=', $start)
                                ->where('check_out_date', '>=', $end);
                        });
                })
                ->sum(DB::raw('DATEDIFF(LEAST(check_out_date, "' . $end->format('Y-m-d') . '"), 
                             GREATEST(check_in_date, "' . $start->format('Y-m-d') . '"))'));

            $availableNights = $totalRooms * $daysInMonth;
            $occupancyRate = $availableNights > 0 ? ($occupiedNights / $availableNights) * 100 : 0;

            $monthlyOccupancy->push([
                'month' => $start->format('F'),
                'occupancy_rate' => $occupancyRate,
                'occupied_nights' => $occupiedNights,
                'available_nights' => $availableNights
            ]);
        }

        $averageMonthlyOccupancy = $monthlyOccupancy->avg('occupancy_rate');

        return [
            'currentOccupancyRate' => $currentOccupancyRate,
            'averageMonthlyOccupancy' => $averageMonthlyOccupancy,
            'monthlyOccupancy' => $monthlyOccupancy,
            'totalRooms' => $totalRooms
        ];
    }
} 