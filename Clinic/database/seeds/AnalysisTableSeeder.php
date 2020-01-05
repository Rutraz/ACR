<?php

use Illuminate\Database\Seeder;

class AnalysisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('analyses')->insert([
            'client_id' => '1',
            'date' => '2020-01-8 09:00:00',
            'state_id' => '3',
        ]);
        DB::table('analyses')->insert([
            'client_id' => '1',
            'date' => '2020-01-09 16:15:06',
            'state_id' => '2',
        ]);
        DB::table('analyses')->insert([
            'client_id' => '2',
            'date' => '2020-01-07 09:00:00',
            'state_id' => '5',
        ]);
    }
}
