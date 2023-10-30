<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('term')->comment('Check whether the customer owes money.1 = cash, 2 = 30days, 3 = 60days, 4 = 90days');
            $table->string('validation_date')->nullable();
            $table->datetime('generate_date');
            $table->boolean('revised')->default(0);
            $table->longtext('remark')->nullable();
            $table->string('status')->default(0)->comment('0 => Draft, 1 => Sent, 2 => Confirm, 3 => Rejected');
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
        Schema::dropIfExists('quotations');
    }
}
