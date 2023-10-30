<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('decrypt_key')->unique();
            $table->string('encrypt_key')->unique();
            $table->string('type')->default(2);
            $table->datetime('email_verified_at')->nullable();
            $table->boolean('two_factor')->default(0);
            $table->string('two_factor_code')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
