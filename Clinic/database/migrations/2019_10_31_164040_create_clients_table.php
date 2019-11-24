<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('clients')) {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');   
            $table->integer('user_id')->unsigned()->index();      
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('CC')->unique();;
            $table->string('adse')->nullable();
            $table->string('morada'); 
            $table->date('idade')->nullable(); 
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
