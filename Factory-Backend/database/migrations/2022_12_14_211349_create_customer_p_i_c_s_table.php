<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPICSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // One Customer has Many PIC
        Schema::create('customer_p_i_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('person_in_change_name')->nullable();
            $table->string('person_in_change_phone')->nullable();
            $table->string('person_in_change_email')->nullable();
            $table->string('person_in_change_remark')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('customer_p_i_c_s');
    }
}
