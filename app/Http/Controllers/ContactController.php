<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use App\Notifications\NewContactMessage;
use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        // Get settings from database or use defaults
        $address = Setting::where('key', 'site.address')->first()?->value ?? '123 Main Street, City, Country';
        $phone = Setting::where('key', 'site.phone')->first()?->value ?? '+1 234 567 890';
        $email = Setting::where('key', 'site.email')->first()?->value ?? 'contact@example.com';

        return view('pages.contact', [
            'siteSettings' => [
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
            ]
        ]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $contact = Contact::create($validated);

        // Notify all admin users
        User::where('usertype', 'admin')->get()
            ->each(function($admin) use ($contact) {
                $admin->notify(new NewContactMessage($contact));
            });

        return back()->with('success', 'Your message has been sent successfully!');
    }
} 