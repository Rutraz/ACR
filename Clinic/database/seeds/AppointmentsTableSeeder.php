<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            'date' => '2020-01-07 11:00:00',
            'state_id' => '4',
            'rating' => '0',
            'comments' => '',
            'medic_id' => '2',
            'client_id' => '1',
        ]);
        DB::table('appointments')->insert([
            'date' => '2020-01-07 12:00:00',
            'state_id' => '5',
            'rating' => '0',
            'comments' => '',
            'medic_id' => '2',
            'client_id' => '2',
        ]);
        DB::table('appointments')->insert([
            'date' => '2020-01-07 16:00:00',
            'state_id' => '2',
            'rating' => '0',
            'comments' => '',
            'medic_id' => '1',
            'client_id' => '2',
        ]);

        DB::table('appointments')->insert([
            'date' => '2020-01-08 14:00:00',
            'state_id' => '2',
            'rating' => '0',
            'comments' => '',
            'medic_id' => '1',
            'client_id' => '1',
        ]);
    }
}
