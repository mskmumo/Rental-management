<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        return view('client.bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'special_requests' => 'nullable|string|max:1000'
        ]);

        $room = Room::findOrFail($request->room_id);
        
        // Calculate number of nights and total price
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price_per_night * $nights;

        // Create the booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'special_requests' => $request->special_requests
        ]);

        // Redirect to payment page
        return redirect()->route('client.payments.create', ['booking' => $booking])
            ->with('success', 'Booking created successfully. Please complete your payment.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('client.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'pending' && $booking->status !== 'confirmed') {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('client.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }
} 