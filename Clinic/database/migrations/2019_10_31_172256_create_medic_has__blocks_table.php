<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicHasBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('medic_has__blocks')) {
        Schema::create('medic_has__blocks', function (Blueprint $table) {
            $table->integer('medic_id')->unsigned()->index();  
            $table->integer('block_id')->unsigned()->index(); 
            $table->foreign('medic_id')->references('id')->on('medics')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->date('date');
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
        Schema::dropIfExists('medic_has__blocks');
    }
}
