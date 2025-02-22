<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', auth()->id())->latest()->paginate(10);
        return view('client.payments.index', compact('payments'));
    }
} 