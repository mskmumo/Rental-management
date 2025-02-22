<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\BookingConfirmation;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('rooms.browse')
                ->with('error', 'Your cart is empty');
        }

        $rooms = Room::whereIn('id', array_keys($cartItems))->get();
        $total = 0;

        foreach ($rooms as $room) {
            $checkIn = Carbon::parse($cartItems[$room->id]['check_in_date']);
            $checkOut = Carbon::parse($cartItems[$room->id]['check_out_date']);
            $nights = $checkIn->diffInDays($checkOut);
            $total += $room->price_per_night * $nights;
        }

        return view('client.checkout.index', compact('rooms', 'cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('rooms.browse')
                ->with('error', 'Your cart is empty');
        }

        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal',
            'card_number' => 'required_if:payment_method,credit_card',
            'expiry_date' => 'required_if:payment_method,credit_card',
            'cvv' => 'required_if:payment_method,credit_card',
        ]);

        try {
            DB::beginTransaction();

            foreach ($cartItems as $roomId => $details) {
                $room = Room::findOrFail($roomId);
                $checkIn = Carbon::parse($details['check_in_date']);
                $checkOut = Carbon::parse($details['check_out_date']);
                $nights = $checkIn->diffInDays($checkOut);
                $amount = $room->price_per_night * $nights;

                // Create booking
                $booking = Booking::create([
                    'user_id' => auth()->id(),
                    'room_id' => $roomId,
                    'check_in_date' => $checkIn,
                    'check_out_date' => $checkOut,
                    'total_price' => $amount,
                    'status' => 'pending'
                ]);

                // Create payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $amount,
                    'payment_method' => $request->payment_method,
                    'transaction_id' => 'TXN_' . uniqid(),
                    'status' => 'completed'
                ]);

                // Update room status
                $room->update(['status' => 'booked']);
            }

            DB::commit();

            // Send booking confirmation email
            $user = auth()->user();
            $user->notify(new BookingConfirmation($booking));

            // Clear cart
            session()->forget('cart');

            return redirect()->route('my.bookings')
                ->with('success', 'Booking completed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred during checkout. Please try again.');
        }
    }
} 