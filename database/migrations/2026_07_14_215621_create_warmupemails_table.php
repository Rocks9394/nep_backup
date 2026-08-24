<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarmupemailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warmupemails', function (Blueprint $table) {
            $table->id();
            $table->string('user_type'); 
            $table->string('name');         
            $table->string('send_to');           
            $table->integer('count')->nullable(); 
            $table->string('subject');            
            $table->text('message');              
            $table->string('attachment')->nullable(); 
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
        Schema::dropIfExists('warmupemails');
    }
}
