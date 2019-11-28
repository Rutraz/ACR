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
            'CC' => '14471858',
            'adse' => '006776769',
            'morada' => 'Caminho do jamboto nº8, St Antonio',
            'idade' => '1997-05-07',
           
        ]);

        
        DB::table('clients')->insert([
            'user_id' => '3',
            'CC' => '12345678',
            'adse' => '006996869',
            'morada' => 'Casa em banda nº3, Matur, Agua de Pena, Machico',
            'idade' => '1995-06-30',
            
        ]);
    }
}
