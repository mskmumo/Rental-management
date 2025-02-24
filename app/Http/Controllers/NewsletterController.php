<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        Newsletter::create([
            'email' => $request->email
        ]);

        $this->sendAdminNotification($request['email']);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    protected function sendAdminNotification($email)
    {
        // You can use Laravel's Mail facade to send an email
        Mail::raw("A new subscription has been made with the email: $email", function ($message) {
            $message->to('admin@example.com') // Replace with your admin email
                    ->subject('New Newsletter Subscription');
        });
    }


} 