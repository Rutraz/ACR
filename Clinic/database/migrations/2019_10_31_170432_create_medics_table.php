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
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('specialty');
            $table->integer('rating');
            $table->string('adse');
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