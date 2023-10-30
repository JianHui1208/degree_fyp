<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLoginLogsTable extends Migration
{
    public function up()
    {
        Schema::create('user_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('login_time')->nullable();
            $table->string('login_ip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
