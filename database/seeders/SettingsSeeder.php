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
                'key' => 'features_title',
                'value' => json_encode('Why Choose Pahali Pazuri'),
                'type' => 'text'
            ],
            [
                'key' => 'features',
                'value' => json_encode([
                    [
                        'icon' => 'fa-star',
                        'title' => 'Premium Accommodations',
                        'description' => 'Experience luxury living with our carefully curated selection of high-quality rental properties.'
                    ],
                    [
                        'icon' => 'fa-shield-alt',
                        'title' => 'Secure Booking',
                        'description' => 'Book with confidence using our secure and transparent booking system with instant confirmation.'
                    ],
                    [
                        'icon' => 'fa-headset',
                        'title' => '24/7 Support',
                        'description' => 'Our dedicated customer service team is available around the clock to assist you with any needs.'
                    ],
                    [
                        'icon' => 'fa-hand-sparkles',
                        'title' => 'Clean & Hygienic',
                        'description' => 'All our properties maintain the highest standards of cleanliness and sanitization.'
                    ],
                    [
                        'icon' => 'fa-location-dot',
                        'title' => 'Prime Locations',
                        'description' => 'Find properties in the most desirable locations with easy access to amenities and attractions.'
                    ],
                    [
                        'icon' => 'fa-gift',
                        'title' => 'Loyalty Rewards',
                        'description' => 'Earn points with every booking and enjoy exclusive benefits as a valued customer.'
                    ]
                ]),
                'type' => 'json'
            ],
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
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]
            );
        }
    }
} 