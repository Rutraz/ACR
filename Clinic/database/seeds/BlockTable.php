<?php

use Illuminate\Database\Seeder;

class BlockTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            'begin_hour' => '9',
            'end_hour' => '13',
        ]);

        DB::table('appointments')->insert([
            'begin_hour' => '14',
            'end_hour' => '17',
        ]);

    }
}
