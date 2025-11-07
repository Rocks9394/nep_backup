<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 ////$table->bigInteger('subject_id')->unsigned();
	 
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->id();			
            $table->bigInteger('subject_id')->unsigned();
			$table->string('name');	
			$table->longText('description')->nullable();
			$table->string('image');
			$table->string('url');
			$table->string('status');            				
            $table->timestamps();
			$table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade');
        });
    }
	
	////$table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade');
    //$table->foreignId('subject_id')->nullable()->constrained("subject")->cascadeOnUpdate()->nullOnDelete();	
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter');
    }
}
