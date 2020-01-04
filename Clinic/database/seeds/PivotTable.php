<?php

use Illuminate\Database\Seeder;

class PivotTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            'medic_id' => '1',
            'block_id' => '1',
            'date' => '2020-01-06'
        ]);
        
    }
   
}

