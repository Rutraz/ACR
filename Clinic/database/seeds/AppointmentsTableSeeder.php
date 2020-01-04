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
            'date' => '2019-11-1 16:15:06',
            'state_id' => '4',
            'rating' => '0',
            'comments' => '',
            'medic_id' => '1',
            'client_id' => '1',
        ]);
        DB::table('appointments')->insert([
            'date' => '2019-10-31 16:15:06',
            'state_id' => '4',
            'rating' => '4',
            'comments' => 'Adorei medico lindo',
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
