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
            'specialty' => "Pediatria"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "Ortopedia"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "Neurologia"
        ]); 
        
        DB::table('specialties')->insert([
            'specialty' => "Ginecologista"
        ]);
        
        DB::table('specialties')->insert([
            'specialty' => "Urologia"
        ]); 
    }
}
