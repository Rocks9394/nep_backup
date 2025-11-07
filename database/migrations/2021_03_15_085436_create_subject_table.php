<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 //$table->bigInteger('class_id')->unsigned();	 
	 
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {
			$table->id();
            $table->bigInteger('class_id')->unsigned();		
			$table->string('name');			
			$table->string('status');
			$table->timestamps();
			$table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');	
        });
    }
	
	 //$table->integer('class_id')->unsigned()->nullable();
	//$table->foreign('class_id')->references('id')->on('class')->onDelete('set null');		
	//$table->integer('category_id')->unsigned()->nullable();    
	//$table->foreignId('class_id')->nullable()->constrained("class")->cascadeOnUpdate()->nullOnDelete();	
	//$table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
    }
}
