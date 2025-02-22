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
            ['name' => 'Studio', 'description' => 'Compact living space'],
            ['name' => 'One Bedroom', 'description' => 'Separate bedroom and living area'],
            ['name' => 'Two Bedroom', 'description' => 'Two separate bedrooms'],
            ['name' => 'Penthouse', 'description' => 'Luxury top floor apartment'],
        ];

        foreach ($apartmentTypes as $type) {
            ApartmentType::create($type);
        }

        // Bed Types
        $bedTypes = [
            ['name' => 'Single', 'description' => 'One single bed'],
            ['name' => 'Double', 'description' => 'One double bed'],
            ['name' => 'Twin', 'description' => 'Two single beds'],
            ['name' => 'Queen', 'description' => 'One queen-size bed'],
            ['name' => 'King', 'description' => 'One king-size bed'],
        ];

        foreach ($bedTypes as $type) {
            BedType::create($type);
        }
    }
} 