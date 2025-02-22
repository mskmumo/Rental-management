<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'hero_title',
                'value' => json_encode('Find Your Perfect Stay'),
                'type' => 'text'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => json_encode('Book unique accommodations and experience comfort like never before.'),
                'type' => 'text'
            ],
            [
                'key' => 'about_content',
                'value' => json_encode('At Pahali Pazuri, we believe that finding the perfect place to stay should be an effortless and enjoyable experience. Since our establishment, we have been dedicated to providing exceptional rental accommodations that combine comfort, luxury, and convenience.'),
                'type' => 'textarea'
            ],
            [
                'key' => 'gallery_title',
                'value' => json_encode('Explore Our Properties'),
                'type' => 'text'
            ],
            [
                'key' => 'gallery_subtitle',
                'value' => json_encode('Discover our handpicked selection of premium accommodations'),
                'type' => 'text'
            ],
            [
                'key' => 'testimonials',
                'value' => json_encode([
                    [
                        'name' => 'John Doe',
                        'rating' => 5,
                        'comment' => 'Amazing experience! The room was perfect and the service was exceptional.',
                        'photo' => null
                    ],
                    [
                        'name' => 'Jane Smith',
                        'rating' => 5,
                        'comment' => 'Beautiful property and very comfortable stay. Will definitely come back!',
                        'photo' => null
                    ],
                    [
                        'name' => 'Mike Johnson',
                        'rating' => 5,
                        'comment' => 'Top-notch amenities and professional staff. Highly recommended!',
                        'photo' => null
                    ]
                ]),
                'type' => 'json'
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
} 