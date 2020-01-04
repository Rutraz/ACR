<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('medics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('specialty_id')->unsigned()->index();  
            $table->foreign('specialty_id')->references('id')->on('specialtys')->onDelete('cascade');
            $table->integer('rating');
            $table->boolean('adse');
            $table->string('calendarid');
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
        Schema::dropIfExists('medics');
    }
}
