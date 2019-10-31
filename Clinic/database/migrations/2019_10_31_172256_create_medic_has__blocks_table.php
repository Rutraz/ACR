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
            $table->unsignedBigInteger('medic_id');  
            $table->unsignedBigInteger('block_id');  
            $table->foreign('medic_id')->references('id')->on('medics');
            $table->foreign('block_id')->references('id')->on('blocks');
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
