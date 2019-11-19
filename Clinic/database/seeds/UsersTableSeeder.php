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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'cellphone' => '923232698' ,
            'password' => bcrypt('12345678'),
        ]); 

        DB::table('users')->insert([
            'name' => 'Cliente1',
            'email' => 'client1@gmail.com',
            'cellphone' => '923232697' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cliente2',
            'email' => 'client2@gmail.com',
            'cellphone' => '923232696' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'medic1',
            'email' => 'medic1@gmail.com',
            'cellphone' => '923232695' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'medic2',
            'email' => 'medic2@gmail.com',
            'cellphone' => '923232694' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'employee1',
            'email' => 'employee1@gmail.com',
            'cellphone' => '923232693' ,
            'password' => bcrypt('12345678'),
        ]);
    }
}
