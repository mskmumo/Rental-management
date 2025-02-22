<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])
            ->latest()
            ->paginate(10);
            
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking cannot be approved.');
        }

        $booking->update([
            'status' => 'confirmed',
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return back()->with('success', 'Booking approved successfully.');
    }

    public function reject(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking cannot be rejected.');
        }

        $booking->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => Auth::id()
        ]);

        return back()->with('success', 'Booking rejected successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    // Add other booking management methods
} 