<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class WelcomeSettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        $defaultSettings = [
            // Hero Section
            'hero_title' => 'Find Your Perfect Stay',
            'hero_subtitle' => 'Book unique accommodations and experience comfort like never before.',
            'hero_image' => null,
            'hero_cta_text' => 'Browse Rooms',
            'hero_cta_link' => '/rooms/browse',
            
            // About Section
            'about_title' => 'About Our Rentals',
            'about_content' => 'Experience luxury and comfort in our carefully curated accommodations.',
            'about_image' => null,
            
            // Features Section
            'features_title' => 'Why Choose Us',
            'features' => '[]',
            
            // Testimonials Section
            'testimonials_title' => 'What Our Guests Say',
            'testimonials' => '[]',
            
            // SEO Settings
            'meta_title' => 'Rental System - Your Perfect Stay',
            'meta_description' => 'Find and book your perfect accommodation with our rental system.',
            'meta_keywords' => 'rentals, accommodation, rooms, booking',
            
            // Contact Information
            'contact_address' => '123 Main Street, City, Country',
            'contact_phone' => '+1 234 567 890',
            'contact_email' => 'contact@example.com',
            
            // Social Media Links
            'social_facebook' => '',
            'social_twitter' => '',
            'social_instagram' => '',
            'social_linkedin' => ''
        ];

        $settings = array_merge($defaultSettings, $settings);
        
        // Decode JSON data
        $settings['features'] = json_decode($settings['features'], true) ?? [];
        $settings['testimonials'] = json_decode($settings['testimonials'], true) ?? [];
        
        return view('admin.welcome-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero Section
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_cta_text' => 'required|string|max:255',
            'hero_cta_link' => 'required|string|max:255',
            
            // About Section
            'about_title' => 'required|string|max:255',
            'about_content' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Features Section
            'features_title' => 'required|string|max:255',
            'features' => 'nullable|array',
            'features.*.icon' => 'required|string',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'required|string',
            
            // Testimonials Section
            'testimonials_title' => 'required|string|max:255',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'required|string|max:255',
            'testimonials.*.comment' => 'required|string',
            'testimonials.*.rating' => 'required|integer|min:1|max:5',
            'testimonials.*.photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // SEO Settings
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            
            // Contact Information
            'contact_address' => 'required|string',
            'contact_phone' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            
            // Social Media Links
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255'
        ]);

        // Handle file uploads
        if ($request->hasFile('hero_image')) {
            $heroImage = $request->file('hero_image')->store('welcome/hero', 'public');
            $validated['hero_image'] = $heroImage;
        }

        if ($request->hasFile('about_image')) {
            $aboutImage = $request->file('about_image')->store('welcome/about', 'public');
            $validated['about_image'] = $aboutImage;
        }

        // Handle testimonial photos
        if (isset($validated['testimonials']) && is_array($validated['testimonials'])) {
            foreach ($validated['testimonials'] as &$testimonial) {
                if (isset($testimonial['photo']) && $testimonial['photo']->isValid()) {
                    $path = $testimonial['photo']->store('testimonials', 'public');
                    $testimonial['photo'] = $path;
                }
            }
        }

        // Convert arrays to JSON
        $validated['features'] = json_encode($validated['features'] ?? []);
        $validated['testimonials'] = json_encode($validated['testimonials'] ?? []);

        // Save all settings
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Clear the cache
        Cache::forget('site_settings');

        return redirect()->route('admin.welcome-settings.index')
            ->with('success', 'Welcome page settings updated successfully.');
    }
} 