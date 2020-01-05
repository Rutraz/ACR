<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
           'user_id' => '1',
           'admin' => true,
        ]);

        DB::table('employees')->insert([
            'user_id' => '6',
            'admin' => false,
         ]);

         DB::table('employees')->insert([
            'user_id' => '7',
            'admin' => false,
         ]);

         DB::table('employees')->insert([
            'user_id' => '8',
            'admin' => false,
         ]);
    }
}
