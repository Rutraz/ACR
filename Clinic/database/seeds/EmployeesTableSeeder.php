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
        ]);

        DB::table('employees')->insert([
            'user_id' => '6',
         ]);

         DB::table('employees')->insert([
            'user_id' => '7',
         ]);
    }
}
