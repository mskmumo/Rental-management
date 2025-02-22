<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class PageController extends Controller
{
    public function about()
    {
        $siteSettings = $this->getSiteSettings();
        return view('pages.about', compact('siteSettings'));
    }

    public function contact()
    {
        $siteSettings = $this->getSiteSettings();
        return view('pages.contact', compact('siteSettings'));
    }

    public function privacy()
    {
        $siteSettings = $this->getSiteSettings();
        return view('pages.privacy', compact('siteSettings'));
    }

    public function terms()
    {
        $siteSettings = $this->getSiteSettings();
        return view('pages.terms', compact('siteSettings'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to(config('mail.admin_address', 'admin@example.com'))
                ->send(new ContactFormMail($validated));

            return redirect()->back()
                ->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->withInput();
        }
    }

    private function getSiteSettings()
    {
        return Cache::remember('site_settings', 86400, function () {
            $settings = Setting::pluck('value', 'key')->toArray();
            
            $defaultSettings = [
                'hero_title' => 'Find Your Perfect Stay',
                'hero_subtitle' => 'Book unique accommodations and experience comfort like never before.',
                'featured_section_title' => 'Featured Properties',
                'about_content' => 'Default about content...',
                'testimonials' => []
            ];

            return array_merge($defaultSettings, $settings);
        });
    }
} 