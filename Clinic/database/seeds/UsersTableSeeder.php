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
            'name' => 'Antonio Variações',
            'email' => 'employee1@gmail.com',
            'cellphone' => '291775124' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Erica Jardim',
            'email' => 'employee2@gmail.com',
            'cellphone' => '291775125' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Vitor Velosa',
            'email' => 'employee3@gmail.com',
            'cellphone' => '291775169' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Filipe Dantas',
            'email' => 'medic3@gmail.com',
            'cellphone' => '986542326' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Alberto Vieira',
            'email' => 'client3@gmail.com',
            'cellphone' => '968526324' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Leonardo Abreu',
            'email' => 'client4@gmail.com',
            'cellphone' => '986147852' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Ruben Abreu',
            'email' => 'client5@gmail.com',
            'cellphone' => '968213542' ,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'João Santos',
            'email' => 'client6@gmail.com',
            'cellphone' => '925654901' ,
            'password' => bcrypt('12345678'),
        ]);
    }
}
