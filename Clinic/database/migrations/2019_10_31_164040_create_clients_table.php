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
            $table->bigIncrements('id');   
            $table->unsignedBigInteger('user_id');      
            $table->foreign('user_id')->references('id')->on('users');
            $table->mediumInteger('CC');
            $table->smallInteger('adse')->nullable();;
            $table->char('morada'); 
            $table->char('idade')->nullable();;  
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
