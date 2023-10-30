<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->comment('Company for this item');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('item_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->comment('Company for this item');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('stock_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->comment('Company for this item');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
