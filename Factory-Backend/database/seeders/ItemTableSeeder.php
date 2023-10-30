<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use App\Models\ItemCategory;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $items = [];

        for ($i = 1; $i <= 500; $i++) {
            $item = [
                'uid' => $faker->uuid,
                'name' => $faker->firstName() .  $i . 'Item',
                'barcode' => $faker->ean13,
                'cost' => $faker->randomFloat(2, 10, 50),
                'price' => $faker->randomFloat(2, 50, 70),
                'quantity' => rand(5, 50),
                'item_category_id' => rand(1, 20),
                'image_id' => rand(1, 20),
                'status' => rand(0, 1),
                'company_id' => rand(1, 10),
                'created_at' => Carbon::now()->subMinutes($i),
                'updated_at' => Carbon::now()->subMinutes($i),
            ];

            array_push($items, $item);
        }

        Item::insert($items);
    }
}
