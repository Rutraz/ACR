<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('appointments')) {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->date('hour');
            $table->smallInteger('state');
            $table->char('comments');
            $table->unsignedBigInteger('medic_id');  
            $table->unsignedBigInteger('client_id');  
            $table->foreign('medic_id')->references('id')->on('medics');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('appointments');
    }
}
