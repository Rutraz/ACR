<?php

use Illuminate\Database\Seeder;

class SpecialtysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            'specialty' => "pernas"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "braços"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "cabeça"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "ginecologista"
        ]); 
    }
}
