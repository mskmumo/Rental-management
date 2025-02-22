<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['room.amenities'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('client.cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1'
        ]);

        $room = Room::findOrFail($request->room_id);
        
        // Calculate number of nights
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);

        // Calculate total price
        $totalPrice = $room->price_per_night * $nights;

        Cart::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests' => $request->guests,
            'total_price' => $totalPrice
        ]);

        return redirect()->route('client.cart.index')
            ->with('success', 'Room added to cart successfully.');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('client.cart.index')
            ->with('success', 'Item removed from cart successfully.');
    }

    public function checkout()
    {
        $cartItems = Cart::with(['room.amenities'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('client.cart.index')
                ->with('error', 'Your cart is empty.');
        }

        return view('client.cart.checkout', compact('cartItems'));
    }
} 