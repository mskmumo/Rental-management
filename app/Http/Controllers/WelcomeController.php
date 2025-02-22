<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Gallery;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class WelcomeController extends Controller
{
    public function index()
    {
        $siteSettings = [];
        
        // Get featured rooms
        $featuredRooms = Room::with(['apartmentType', 'bedType'])
            ->where('status', '=', 'available')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        // Get gallery images
        $galleryImages = Gallery::where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        // Only try to get site settings if the table exists
        if (Schema::hasTable('site_settings')) {
            try {
                $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                Log::error('Error fetching site settings: ' . $e->getMessage());
            }
        }

        return view('welcome', compact('siteSettings', 'featuredRooms', 'galleryImages'));
    }
} 