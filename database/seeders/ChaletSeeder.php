<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chalet;

class ChaletSeeder extends Seeder
{
    public function run(): void
    {
        // Chalets for owner_id 3
        Chalet::create([
            'name' => 'Luxury Beach Chalet',
            'owner_id' => 3,
            'price_per_day' => 150.00,
            'address' => 'Balqa',
            'description' => 'A luxurious beach chalet with a stunning sea view.',
            'discount' => 10.00,
            'status' => 'available',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'wifi' => true,
            'pool' => true,
            'air_conditioners' => 2,
            'parking_spaces' => 2,
            'area' => 250,
            'barbecue' => true,
            'view' => 'sea',
            'kitchen' => true,
            'kids_play_area' => true,
            'pets_allowed' => false,
        ]);

        Chalet::create([
            'name' => 'Mountain Retreat',
            'owner_id' => 3,
            'price_per_day' => 100.00,
            'address' => 'Amman',
            'description' => 'A cozy retreat in the mountains with a breathtaking view.',
            'discount' => 5.00,
            'status' => 'available',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'wifi' => true,
            'pool' => false,
            'air_conditioners' => 1,
            'parking_spaces' => 1,
            'area' => 180,
            'barbecue' => true,
            'view' => 'mountain',
            'kitchen' => true,
            'kids_play_area' => false,
            'pets_allowed' => true,
        ]);

        // Chalets for owner_id 4
        Chalet::create([
            'name' => 'City Escape Chalet',
            'owner_id' => 4,
            'price_per_day' => 120.00,
            'address' => 'Irbid',
            'description' => 'A modern chalet in the heart of the city.',
            'discount' => 8.00,
            'status' => 'available',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'wifi' => true,
            'pool' => false,
            'air_conditioners' => 2,
            'parking_spaces' => 1,
            'area' => 200,
            'barbecue' => false,
            'view' => 'city',
            'kitchen' => true,
            'kids_play_area' => true,
            'pets_allowed' => true,
        ]);

        Chalet::create([
            'name' => 'Lakeside Haven',
            'owner_id' => 4,
            'price_per_day' => 130.00,
            'address' => 'Balqa',
            'description' => 'A peaceful lakeside chalet with stunning views.',
            'discount' => 7.00,
            'status' => 'available',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'wifi' => true,
            'pool' => true,
            'air_conditioners' => 2,
            'parking_spaces' => 2,
            'area' => 220,
            'barbecue' => true,
            'view' => 'mountain',
            'kitchen' => true,
            'kids_play_area' => false,
            'pets_allowed' => false,
        ]);

        Chalet::create([
            'name' => 'Desert Oasis',
            'owner_id' => 3,
            'price_per_day' => 90.00,
            'address' => '555 Desert Road',
            'description' => 'A warm and inviting chalet in the middle of the desert.',
            'discount' => 6.00,
            'status' => 'available',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'wifi' => false,
            'pool' => false,
            'air_conditioners' => 1,
            'parking_spaces' => 1,
            'area' => 150,
            'barbecue' => false,
            'view' => 'none',
            'kitchen' => true,
            'kids_play_area' => false,
            'pets_allowed' => true,
        ]);

        Chalet::create([
            'name' => 'Forest Cabin',
            'owner_id' => 4,
            'price_per_day' => 110.00,
            'address' => '777 Woodland Lane',
            'description' => 'A cozy cabin surrounded by lush forests.',
            'discount' => 9.00,
            'status' => 'not available',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'wifi' => false,
            'pool' => false,
            'air_conditioners' => 1,
            'parking_spaces' => 1,
            'area' => 170,
            'barbecue' => true,
            'view' => 'mountain',
            'kitchen' => true,
            'kids_play_area' => false,
            'pets_allowed' => true,
        ]);
    }
}