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
            'specialty_id' => '1',
            'rating' => '5',
            'adse' => '3545',       
        ]);

        DB::table('medics')->insert([
            'user_id' => '8',
            'specialty_id' => '2',
            'rating' => '3',
            'adse' => '3546',      
        ]);

        DB::table('medics')->insert([
            'user_id' => '5',
            'specialty_id' => '2',
            'rating' => '3',
            'adse' => '3546',      
        ]);

        
    }
}
