<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('bar_code_id')->unique()->comment('bar code number');
            $table->string('name');
            $table->unsignedBigInteger('image_id')->comment('product Image ID');
            $table->foreign('image_id')->references('id')->on('images');
            $table->unsignedBigInteger('product_category_id')->comment('Product Category ID');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
