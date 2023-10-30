<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeBoardsTable extends Migration
{
    public function up()
    {
        Schema::create('notice_boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('type');
            $table->datetime('post_at')->nullable();
            $table->unsignedBigInteger('image_id')->comment('Image ID');
            $table->foreign('image_id')->references('id')->on('images');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
