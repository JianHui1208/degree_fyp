<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemCategory;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $itemCategories = [];

        for ($i = 1; $i <= 20; $i++) {
            $itemCategory = [
                'uid' => $faker->uuid,
                'name' => $faker->firstName() . $i . 'ItemCat',
                'company_id' => rand(1, 10),
                'status' => rand(0, 1),
                'created_at' => Carbon::now()->subMinutes($i),
                'updated_at' => Carbon::now()->subMinutes($i),
            ];

            array_push($itemCategories, $itemCategory);
        }

        ItemCategory::insert($itemCategories);
    }
}
