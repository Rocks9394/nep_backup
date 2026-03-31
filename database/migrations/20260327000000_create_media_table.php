<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->date('date')->nullable();
            $table->string('media_type'); // 'image' or 'video'
            $table->string('file_path');
            $table->string('file_name');
            $table->integer('file_size'); // in bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}