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
          
        DB::table('clients')->insert([
            'user_id' => '12',
            'CC' => '45627895',
            'adse' => '006696869',
            'morada' => 'Rua do Caniço do Meio nº3',
            'idade' => '1997-04-20',
            
        ]);
          
        DB::table('clients')->insert([
            'user_id' => '10',
            'CC' => '15493568',
            'adse' => '006970869',
            'morada' => 'Funchal Rua da velha nº23',
            'idade' => '1980-03-17',
            
        ]);
          
        DB::table('clients')->insert([
            'user_id' => '11',
            'CC' => '12475648',
            'adse' => '006998169',
            'morada' => 'Camara de lobos, Rua da mão leve nº0',
            'idade' => '1958-07-22',
            
        ]);
          
        DB::table('clients')->insert([
            'user_id' => '13',
            'CC' => '12456875',
            'adse' => '006996855',
            'morada' => 'Ribeira Brava, Rua da Levada cheia nº66',
            'idade' => '1998-05-20',
            
        ]);
    }
}
