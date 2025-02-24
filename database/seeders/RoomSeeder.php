<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'name' => 'Ocean View Luxury Suite',
                'description' => 'Experience luxury living with breathtaking ocean views. This spacious suite features premium furnishings and modern amenities.',
                'price_per_night' => 299.99,
                'capacity' => 2,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 1, // Luxury Suite
                'bed_type_id' => 1, // King Size
                'image_path' => 'rooms/luxury-ocean-suite.jpg',
                'amenities' => [1, 2, 3, 4, 5] // WiFi, AC, TV, Kitchen, Washing Machine
            ],
            [
                'name' => 'Executive Business Suite',
                'description' => 'Perfect for business travelers, this modern suite offers a dedicated workspace and high-speed internet.',
                'price_per_night' => 249.99,
                'capacity' => 2,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 2, // Executive Room
                'bed_type_id' => 2, // Queen Size
                'image_path' => 'rooms/executive-suite.jpg',
                'amenities' => [1, 2, 3, 6, 9] // WiFi, AC, TV, Parking, Security
            ],
            [
                'name' => 'Family Comfort Suite',
                'description' => 'Spacious suite perfect for families, featuring separate living and sleeping areas.',
                'price_per_night' => 349.99,
                'capacity' => 4,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 4, // Family Suite
                'bed_type_id' => 3, // Twin Beds
                'image_path' => 'rooms/family-suite.jpg',
                'amenities' => [1, 2, 3, 4, 7] // WiFi, AC, TV, Kitchen, Pool
            ],
            [
                'name' => 'Deluxe Studio',
                'description' => 'Modern studio apartment with all essential amenities and stylish decor.',
                'price_per_night' => 199.99,
                'capacity' => 2,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 3, // Deluxe Studio
                'bed_type_id' => 4, // Double Bed
                'image_path' => 'rooms/deluxe-studio.jpg',
                'amenities' => [1, 2, 3, 4, 10] // WiFi, AC, TV, Kitchen, Balcony
            ],
            [
                'name' => 'Premium Ocean Suite',
                'description' => 'Luxurious suite with panoramic ocean views and premium amenities.',
                'price_per_night' => 399.99,
                'capacity' => 2,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 5, // Ocean View Room
                'bed_type_id' => 5, // California King
                'image_path' => 'rooms/premium-ocean-suite.jpg',
                'amenities' => [1, 2, 3, 7, 8] // WiFi, AC, TV, Pool, Gym
            ],
            [
                'name' => 'Luxury Garden Suite',
                'description' => 'Peaceful suite with private garden access and luxury amenities.',
                'price_per_night' => 279.99,
                'capacity' => 2,
                'status' => 'available',
                'is_featured' => true,
                'apartment_type_id' => 1, // Luxury Suite
                'bed_type_id' => 1, // King Size
                'image_path' => 'rooms/garden-suite.jpg',
                'amenities' => [1, 2, 3, 4, 11] // WiFi, AC, TV, Kitchen, Pet Friendly
            ]
        ];

        foreach ($rooms as $roomData) {
            $amenities = $roomData['amenities'];
            unset($roomData['amenities']);
            
            $room = Room::create($roomData);
            $room->amenities()->attach($amenities);
        }
    }
} 