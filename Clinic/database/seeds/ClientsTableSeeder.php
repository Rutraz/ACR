<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'user_id' => '2',
            'CC' => '6969',
            'adse' => '2345',
            'morada' => 'Casa da tua prima nº69',
            'idade' => '1996-02-16',
           
        ]);

        
        DB::table('clients')->insert([
            'user_id' => '3',
            'CC' => '6869',
            'adse' => '3345',
            'morada' => 'Casa da teu primo nº69',
            'idade' => '1996-02-16',
            
        ]);
    }
}
