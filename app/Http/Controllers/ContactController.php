<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContactMessage;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
        return view('pages.contact', compact('siteSettings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            $contactMessage = ContactMessage::create($validated);

            // Notify admin users
            $admins = User::where('usertype', 'admin')->get();
            Notification::send($admins, new NewContactMessage($contactMessage));

            return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->withInput();
        }
    }
} 