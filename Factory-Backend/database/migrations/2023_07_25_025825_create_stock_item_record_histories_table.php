<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockItemRecordHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_item_record_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_history_id');
            $table->foreign('stock_history_id')->references('id')->on('stock_histories');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('old_quantity')->comment('old quantity of stock');
            $table->integer('new_quantity')->comment('new quantity of stock');
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
        Schema::dropIfExists('stock_item_record_histories');
    }
}
