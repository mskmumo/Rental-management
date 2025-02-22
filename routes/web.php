<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Client\RoomBrowseController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Client\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\WelcomeSettingsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Room routes
Route::prefix('rooms')->name('rooms.')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('index');
    Route::get('/browse', [RoomController::class, 'browse'])->name('browse');
    Route::get('/search', [RoomController::class, 'search'])->name('search');
    Route::get('/{room}', [RoomController::class, 'show'])->name('show');
});

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Newsletter route
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Authentication routes...
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Redirection
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('client.dashboard');
    })->name('dashboard');
});

// Client Routes
Route::middleware(['auth', 'clientMiddleware'])->prefix('client')->name('client.')->group(function () {
    // Client Dashboard
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // Booking Routes
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/my-bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Payment Routes
    Route::get('/payments/create/{booking}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/my-payments', [PaymentController::class, 'index'])->name('payments.index');

    // Notifications
    Route::get('/notifications', [ClientController::class, 'notifications'])->name('notifications');
    Route::patch('/notifications/{notification}/mark-as-read', [ClientController::class, 'markNotificationAsRead'])
        ->name('notifications.mark-as-read');
});

// Gallery Route
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Admin Routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Resource Routes
    Route::resource('rooms', RoomController::class);
    Route::resource('bookings', AdminBookingController::class);
    Route::resource('payments', AdminPaymentController::class);
    Route::resource('users', UserController::class);
    Route::resource('gallery', GalleryController::class);
    
    // Booking Management
    Route::patch('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::patch('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/bookings', [ReportController::class, 'bookings'])->name('bookings');
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        Route::get('/occupancy', [ReportController::class, 'occupancy'])->name('occupancy');
    });

    // Settings
    Route::get('/welcome-settings', [WelcomeSettingsController::class, 'index'])->name('welcome-settings.index');
    Route::put('/welcome-settings', [WelcomeSettingsController::class, 'update'])->name('welcome-settings.update');
});

// Static pages
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/careers', 'pages.careers')->name('careers');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Add these routes if missing
Route::get('/rooms/browse', [RoomBrowseController::class, 'index'])->name('rooms.browse');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Add these routes after your existing routes
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms');