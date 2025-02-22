<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room', 'payment'])
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(10);

        return view('client.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::user()->id) {
            abort(403);
        }

        return view('client.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::user()->id) {
            abort(403);
        }

        if ($booking->status === 'confirmed') {
            $booking->update(['status' => 'cancelled']);
            $booking->room->update(['status' => 'available']);

            return redirect()->route('my.bookings')
                ->with('success', 'Booking cancelled successfully');
        }

        return back()->with('error', 'Unable to cancel this booking');
    }
} 