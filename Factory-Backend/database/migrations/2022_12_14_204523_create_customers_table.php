<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('sstid')->unique();
            $table->string('company_name')->unique();
            $table->string('company_email')->unique();
            $table->string('company_phone')->unique();
            $table->string('fax')->unique();
            $table->longtext('address')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->default(0)->comment('0 = Inactive, 1 = Active');
            $table->unsignedBigInteger('customer_category_id');
            $table->foreign('customer_category_id')->references('id')->on('customer_categories');
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->foreign('avatar_id')->references('id')->on('images');
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
        Schema::dropIfExists('customers');
    }
}
