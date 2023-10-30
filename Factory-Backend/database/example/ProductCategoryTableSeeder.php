<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $product_categories = [];

        for ($i = 1; $i <= 5; $i++) {
            $product_category = [
                'uid'               => uniqid('UID'),
                'name'              => 'ProductCategory' . $i,
                'is_active'         => rand(0, 1),
                'created_at'        => Carbon::now()->addMinutes($i),
                'updated_at'        => Carbon::now()->addMinutes($i),
            ];

            array_push($product_categories, $product_category);
        }

        ProductCategory::insert($product_categories);
    }
}
