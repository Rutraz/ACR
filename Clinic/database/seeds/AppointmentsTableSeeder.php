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
            'state' => '2',
            'comments' => 'O paciente está a beira da morte',
            'medic_id' => '1',
            'client_id' => '1',
        ]);
        DB::table('appointments')->insert([
            'date' => '2019-10-31 16:15:06',
            'state' => '2',
            'comments' => 'O paciente está fino',
            'medic_id' => '2',
            'client_id' => '2',
        ]);
        DB::table('appointments')->insert([
            'date' => '2019-11-16 16:15:06',
            'state' => '2',
            'comments' => 'O paciente está fino',
            'medic_id' => '1',
            'client_id' => '2',
        ]);

        DB::table('appointments')->insert([
            'date' => '2019-11-18 16:15:06',
            'state' => '2',
            'comments' => 'O paciente está a beira da morte por causa do joelho',
            'medic_id' => '1',
            'client_id' => '1',
        ]);
    }
}
