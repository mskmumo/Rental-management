<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'admin',
        ]);

        // Run seeders in correct order
        $this->call([
            RoomTypesSeeder::class,    // Seeds apartment_types and bed_types
            SettingsSeeder::class,      // Seeds site settings
            GallerySeeder::class,
        ]);
    }
}
