<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chalet;
use App\Models\Image;

class ChaletImageSeeder extends Seeder
{
    public function run(): void
    {
        // Define the images for each chalet
        $images = [
            1 => ['a1.jpg', 'a2.jpg', 'a3.jpg', 'a4.jpg', 'a5.jpg'], // Chalet 1
            2 => ['b1.jpg', 'b2.jpg', 'b3.jpg', 'b4.jpg', 'b5.jpg'], // Chalet 2
            3 => ['c1.jpg', 'c2.jpg', 'c3.jpg', 'c4.jpg', 'c5.jpg'], // Chalet 3
            4 => ['d1.jpg', 'd2.jpg', 'd3.jpg', 'd4.jpg', 'd5.jpg'], // Chalet 4
            5 => ['e1.jpg', 'e2.jpg', 'e3.jpg', 'e4.jpg', 'e5.jpg'], // Chalet 5
            6 => ['h1.jpg', 'h2.jpg', 'h3.jpg', 'h4.jpg', 'h5.jpg', 'h6.jpg'], // Chalet 6
        ];

        // Loop through each chalet and assign images
        foreach ($images as $chaletId => $imageList) {
            foreach ($imageList as $image) {
                Image::create([
                    'chalet_id' => $chaletId,
                    'image' => 'img/' . $image,  // Path to the image
                ]);
            }
        }
    }
}
