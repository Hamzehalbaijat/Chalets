<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner_profile;

class OwnerProfileSeeder extends Seeder
{
    public function run(): void
    {
        Owner_profile::create([
            'user_id' => 3,
            'address' => '123 Main Street, City A',
            'image' => 'owner3.jpg',
            'phone_number' => '123-456-7890',
        ]);

        Owner_profile::create([
            'user_id' => 4,
            'address' => '456 Elm Street, City B',
            'image' => 'owner4.jpg',
            'phone_number' => '987-654-3210',
        ]);
    }
}
