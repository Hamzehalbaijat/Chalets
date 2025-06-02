<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Chalet;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $chalets = Chalet::whereBetween('id', [1, 6])->pluck('id'); // Get chalet IDs from 1 to 6
        $users = User::pluck('id'); // Get all user IDs

        foreach ($chalets as $chaletId) {
            for ($i = 0; $i < 10; $i++) {
                Review::create([
                    'user_id' => $users->random(),
                    'chalet_id' => $chaletId,
                    'comment' => "This is a sample review for chalet ID .",
                    'rate' => rand(1, 5),
                ]);
            }
        }
    }
}
