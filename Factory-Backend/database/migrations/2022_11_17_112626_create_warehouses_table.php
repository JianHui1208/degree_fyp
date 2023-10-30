<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('UID')->unique();
            $table->string('name');
            $table->string('remark')->nullable();
            $table->boolean('status')->default(0)->comment('0 = Inactive, 1 = Active');
            $table->unsignedBigInteger('warehouse_category_id')->nullable();
            $table->foreign('warehouse_category_id')->references('id')->on('warehouse_categories');
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
        Schema::dropIfExists('warehouses');
    }
}
