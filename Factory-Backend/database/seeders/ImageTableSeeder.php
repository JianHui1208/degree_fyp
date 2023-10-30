<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [];

        for ($i = 1; $i <= 20; $i++) {
            $image = [
                'title'             => 'Image' . $i,
                'type'              => rand(0, 2),
                'created_at'        => Carbon::now()->addMinutes($i),
                'updated_at'        => Carbon::now()->addMinutes($i),
            ];

            array_push($images, $image);
        }

        Image::insert($images);
    }
}
