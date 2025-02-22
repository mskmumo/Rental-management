<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
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
        return view('admin.reports.index');
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