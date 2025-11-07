<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterConceptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 //$table->bigInteger('chapter_id')->unsigned();
	 //$table->integer('chapter_id')->unsigned()->nullable();  
	 
    public function up()
    {
        Schema::create('chapter_concept', function (Blueprint $table){
            $table->id();   
            $table->bigInteger('chapter_id')->unsigned();				
			$table->string('name');	
			$table->longText('description')->nullable();
			$table->longText('learning_outcomes')->nullable();
			$table->string('image');
			$table->string('url');
			$table->string('status');            
            $table->timestamps();			
			$table->foreign('chapter_id')->references('id')->on('chapter')->onDelete('cascade');			
        });
    }
	
	//$table->foreign('chapter_id')->references('id')->on('chapter')->onDelete('cascade'); 
    //$table->foreignId('chapter_id')->nullable()->constrained("chapter")->cascadeOnUpdate()->nullOnDelete();
    /**
     * Reverse the migrations.
     *
     * @return void
    */
	
    public function down()
    {
        Schema::dropIfExists('chapter_concept');
    }
}
