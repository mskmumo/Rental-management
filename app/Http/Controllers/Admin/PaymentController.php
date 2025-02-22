<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }
} 