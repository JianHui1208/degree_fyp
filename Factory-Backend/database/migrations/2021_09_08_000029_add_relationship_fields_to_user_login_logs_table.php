<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserLoginLogsTable extends Migration
{
    public function up()
    {
        Schema::table('user_login_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4825334')->references('id')->on('users');
        });
    }
}
