<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $images = [
            [
                'title' => 'Luxury Suite',
                'description' => 'Experience unparalleled luxury in our premium suite',
                'image_path' => 'gallery/luxury-suite.jpg',
                'is_featured' => true
            ],
            [
                'title' => 'Ocean View Room',
                'description' => 'Wake up to breathtaking ocean views',
                'image_path' => 'gallery/ocean-view.jpg',
                'is_featured' => true
            ],
            [
                'title' => 'Executive Suite',
                'description' => 'Perfect for business travelers',
                'image_path' => 'gallery/executive-suite.jpg',
                'is_featured' => true
            ],
            [
                'title' => 'Swimming Pool',
                'description' => 'Relax by our infinity pool',
                'image_path' => 'gallery/pool.jpg',
                'is_featured' => false
            ],
            [
                'title' => 'Restaurant',
                'description' => 'Fine dining experience',
                'image_path' => 'gallery/restaurant.jpg',
                'is_featured' => false
            ],
            [
                'title' => 'Spa Center',
                'description' => 'Rejuvenate your body and mind',
                'image_path' => 'gallery/spa.jpg',
                'is_featured' => false
            ]
        ];

        foreach ($images as $image) {
            Gallery::create($image);
        }
    }
} 