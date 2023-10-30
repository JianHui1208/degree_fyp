<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('layout')->nullable();
            $table->string('type')->nullable();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
