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
            
        ]);
        DB::table('states')->insert([
            'state' => 'Em espera',
            
        ]); 
        DB::table('states')->insert([
            'state' => 'Aceite',
        ]);
        DB::table('states')->insert([
            'state' => 'Concluido',
        ]);
        
        DB::table('states')->insert([
            'state' => 'Cancelado',
        ]);
        DB::table('states')->insert([
            'state' => 'Indesponivel',
        ]);

    }
}
