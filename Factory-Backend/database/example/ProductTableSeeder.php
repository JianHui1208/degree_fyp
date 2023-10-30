<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $baseController = new BaseController();
        $products = [];

        $product_category = ProductCategory::get('id')->toArray();
        $min_product_category = min($product_category);
        $max_product_category = max($product_category);

        $image = Image::get('id')->toArray();
        $min_image = min($image);
        $max_image = max($image);

        for ($i = 1; $i <= 20; $i++) {
            $product = [
                'uid'                   => $baseController->generateUID('product', 4),
                'bar_code_id'           => $this->generateRandomNumber(),
                'name'                  => 'Product'.$i,
                'product_category_id'   => rand($min_product_category['id'], $max_product_category['id']),
                'image_id'              => rand($min_image['id'], $max_image['id']),
                'status'                => rand(0, 1),
                'created_at'            => Carbon::now()->addMinutes($i),
                'updated_at'            => Carbon::now()->addMinutes($i),
            ];

            array_push($products, $product);
        }

        Product::insert($products);
    }

    private function generateRandomNumber($length = 13)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
