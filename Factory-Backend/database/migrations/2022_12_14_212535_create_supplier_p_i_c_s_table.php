<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPICSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_p_i_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('person_in_change_name')->nullable();
            $table->string('person_in_change_phone')->nullable();
            $table->string('person_in_change_email')->nullable();
            $table->string('person_in_change_remark')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('supplier_p_i_c_s');
    }
}
