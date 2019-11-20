<?php

use Illuminate\Database\Seeder;

class MedicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medics')->insert([
            'user_id' => '4',
            'specialty' => 'Cona',
            'rating' => '3',
            'adse' => '3545',       
        ]);

        DB::table('medics')->insert([
            'user_id' => '5',
            'specialty' => 'tetas',
            'rating' => '3',
            'adse' => '3546',      
        ]);
    }
}
