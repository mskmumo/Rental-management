<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function index()
    {
        $payments = Auth::user()->payments()
            ->with(['booking.room'])
            ->latest()
            ->paginate(10);

        $totalAmount = Auth::user()->payments()
            ->where('status', 'completed')
            ->sum('amount');

        $totalTransactions = Auth::user()->payments()->count();

        $lastPayment = Auth::user()->payments()
            ->latest()
            ->first();

        return view('client.payments.index', compact('payments', 'totalAmount', 'totalTransactions', 'lastPayment'));
    }

    public function create(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->payment()->exists()) {
            return redirect()->route('client.bookings.show', $booking)
                ->with('error', 'Payment already exists for this booking.');
        }

        return view('client.payments.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'phone_number' => 'required|regex:/^[0-9]{9}$/',
            'payment_method' => 'required|in:mpesa'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($booking->payment()->exists()) {
            return redirect()->route('client.bookings.show', $booking)
                ->with('error', 'Payment already exists for this booking.');
        }

        try {
            // Format the phone number to include country code
            $phoneNumber = '+254' . $request->phone_number;

            // Create a pending payment record
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'booking_id' => $booking->id,
                'amount' => $request->amount,
                'payment_method' => 'mpesa',
                'status' => 'pending'
            ]);

            // Initiate STK Push
            $response = $this->mpesaService->initiateSTKPush(
                $phoneNumber,
                $request->amount,
                'PAY-' . $payment->id
            );

            if (isset($response['ResponseCode']) && $response['ResponseCode'] === '0') {
                return redirect()->route('client.bookings.show', $booking)
                    ->with('success', 'Payment initiated. Please check your phone to complete the transaction.');
            }

            // If STK push failed, update payment status and return error
            $payment->update(['status' => 'failed']);
            return back()->with('error', 'Failed to initiate payment. Please try again.');

        } catch (\Exception $e) {
            \Log::error('M-Pesa payment error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }

    public function show(Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.payments.show', compact('payment'));
    }
} 