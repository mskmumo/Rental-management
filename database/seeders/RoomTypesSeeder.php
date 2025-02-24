<?php

namespace Database\Seeders;

use App\Models\ApartmentType;
use App\Models\BedType;
use Illuminate\Database\Seeder;

class RoomTypesSeeder extends Seeder
{
    public function run()
    {
        // Apartment Types
        $apartmentTypes = [
            [
                'name' => 'Luxury Suite',
                'description' => 'Spacious luxury suite with premium amenities'
            ],
            [
                'name' => 'Executive Room',
                'description' => 'Modern room perfect for business travelers'
            ],
            [
                'name' => 'Deluxe Studio',
                'description' => 'Comfortable studio with kitchenette'
            ],
            [
                'name' => 'Family Suite',
                'description' => 'Large suite ideal for families'
            ],
            [
                'name' => 'Ocean View Room',
                'description' => 'Room with stunning ocean views'
            ]
        ];

        foreach ($apartmentTypes as $type) {
            ApartmentType::create($type);
        }

        // Bed Types
        $bedTypes = [
            [
                'name' => 'King Size',
                'description' => 'Luxurious king-size bed'
            ],
            [
                'name' => 'Queen Size',
                'description' => 'Comfortable queen-size bed'
            ],
            [
                'name' => 'Twin Beds',
                'description' => 'Two single beds'
            ],
            [
                'name' => 'Double Bed',
                'description' => 'Standard double bed'
            ],
            [
                'name' => 'California King',
                'description' => 'Extra-large California king bed'
            ]
        ];

        foreach ($bedTypes as $type) {
            BedType::create($type);
        }
    }
} 