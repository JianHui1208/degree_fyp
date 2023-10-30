<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('UID')->unique();
            $table->string('company_name')->unique();
            $table->string('company_email')->unique();
            $table->string('company_phone')->unique();
            $table->string('fax')->unique();
            $table->string('currency');
            $table->unsignedBigInteger('avatar_id')->comment('Item Image ID');
            $table->foreign('avatar_id')->references('id')->on('images');
            $table->unsignedBigInteger('supplier_category_id');
            $table->foreign('supplier_category_id')->references('id')->on('supplier_categories');
            $table->longtext('address')->nullable();
            $table->string('remark')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('suppliers');
    }
}
