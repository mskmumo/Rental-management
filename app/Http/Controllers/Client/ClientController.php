<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->usertype !== 'client') {
            return redirect('/');
        }
        return view('client.dashboard');
    }

    /**
     * Display the client dashboard.
     */
    public function dashboard(): View
    {
        $user = Auth::user();

        // Get active bookings count
        $activeBookings = Booking::where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        // Calculate total spent
        $totalSpent = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->sum('total_price');

        // Get loyalty points (you can implement your own logic)
        $loyaltyPoints = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->count() * 100; // Example: 100 points per booking

        // Get recent bookings
        $recentBookings = Booking::with('room')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Get unread notifications (with error handling)
        try {
            $notifications = $user->unreadNotifications()
                ->latest()
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            $notifications = collect(); // Return empty collection if notifications table doesn't exist
        }

        return view('client.dashboard', compact(
            'activeBookings',
            'totalSpent',
            'loyaltyPoints',
            'recentBookings',
            'notifications'
        ));
    }

    /**
     * Display the notifications page.
     */
    public function notifications(): View
    {
        $notifications = Auth::user()
            ->notifications()
            ->paginate(10);

        return view('client.notifications', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markNotificationAsRead(string $id)
    {
        $notification = Auth::user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read');
    }
}
