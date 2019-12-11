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
            'name' => 'Joao Fernandes',
            'email' => 'admin@admin.com',
            'cellphone' => '291775123' ,
            'password' => bcrypt('admin123'),
        ]); 

        DB::table('users')->insert([
            'name' => 'Antonio da Serra',
            'email' => 'client1@gmail.com',
            'cellphone' => '923232697' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Deusivaldo Jesus',
            'email' => 'client2@gmail.com',
            'cellphone' => '923232696' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bonifacio Pedra',
            'email' => 'medic1@gmail.com',
            'cellphone' => '923232695' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Antonieta Paixão',
            'email' => 'medic2@gmail.com',
            'cellphone' => '923232694' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Alberta',
            'email' => 'employee1@gmail.com',
            'cellphone' => '291775124' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Albertino Rocha',
            'email' => 'employee2@gmail.com',
            'cellphone' => '291775125' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Filipe Corneto',
            'email' => 'medic3@gmail.com',
            'cellphone' => '923234694' ,
            'password' => bcrypt('12345678'),
        ]);
    }
}
