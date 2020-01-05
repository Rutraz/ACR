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
            'adse' => true,
            'calendarid' => '1i29600sqpel6cuovbc3g6qhqc@group.calendar.google.com',       
        ]);

        DB::table('medics')->insert([
            'user_id' => '9',
            'specialty_id' => '2',
            'rating' => '3',
            'adse' => false,      
            'calendarid' => '6heq67kjdv7q0fo50fe6edjp18@group.calendar.google.com',       
        ]);

        DB::table('medics')->insert([
            'user_id' => '5',
            'specialty_id' => '2',
            'rating' => '3',
            'adse' => true,   
            'calendarid' => 'sfnd59gv3n35b6f10kfd31oagk@group.calendar.google.com',          
        ]);

        
    }
}
