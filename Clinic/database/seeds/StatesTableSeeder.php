<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'state' => 'Disponivel',
            'color' => '#33cc33'
            
        ]);
        DB::table('states')->insert([
            'state' => 'Em espera',
            'color' => '#ffff33'
            
        ]); 
        DB::table('states')->insert([
            'state' => 'Aceite',
            'color' => '#248f24'
        ]);
        DB::table('states')->insert([
            'state' => 'Concluido',
            'color' => '#0066ff'
        ]);
        
        DB::table('states')->insert([
            'state' => 'Cancelado',
            'color' => '#ff0000'
        ]);
        DB::table('states')->insert([
            'state' => 'Indesponivel',
            'color' => '#e63900'
        ]);

    }
}
