<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('name');
            $table->string('barcode')->unique();
            $table->double('cost', 10, 2);
            $table->double('price', 10, 2);
            $table->integer('quantity')->comment('Item Inventory Quantity');
            $table->unsignedBigInteger('item_category_id');
            $table->foreign('item_category_id')->references('id')->on('item_categories');
            $table->unsignedBigInteger('image_id')->nullable()->comment('Item Image ID');
            $table->foreign('image_id')->references('id')->on('images');
            $table->unsignedBigInteger('warehouse_id')->nullable()->comment('Warehouse for storing items');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Supplier for this item');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->boolean('status')->default(0)->comment('0 = Inactive, 1 = Active');
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
        Schema::dropIfExists('items');
    }
}
