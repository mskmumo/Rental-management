<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            ['name' => 'Wi-Fi', 'icon' => 'wifi'],
            ['name' => 'Air Conditioning', 'icon' => 'snowflake'],
            ['name' => 'TV', 'icon' => 'tv'],
            ['name' => 'Kitchen', 'icon' => 'utensils'],
            ['name' => 'Washing Machine', 'icon' => 'washing-machine'],
            ['name' => 'Free Parking', 'icon' => 'parking'],
            ['name' => 'Swimming Pool', 'icon' => 'swimming-pool'],
            ['name' => 'Gym', 'icon' => 'dumbbell'],
            ['name' => 'Security System', 'icon' => 'shield-alt'],
            ['name' => 'Balcony', 'icon' => 'door-open'],
            ['name' => 'Pet Friendly', 'icon' => 'paw'],
            ['name' => '24/7 Support', 'icon' => 'headset']
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
