<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
             'id' => '69',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'cellphone' => '923232' ,
            'password' => bcrypt('1234'),
        ]); 

        DB::table('users')->insert([
            'name' => 'Cliente1',
            'email' => 'client1@gmail.com',
            'cellphone' => '923132' ,
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cliente2',
            'email' => 'client2@gmail.com',
            'cellphone' => '924232' ,
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'medic1',
            'email' => 'medic1@gmail.com',
            'cellphone' => '925232' ,
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'medic2',
            'email' => 'medic2@gmail.com',
            'cellphone' => '925272' ,
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'employee1',
            'email' => 'employee1@gmail.com',
            'cellphone' => '925672' ,
            'password' => bcrypt('1234'),
        ]);
    }
}
