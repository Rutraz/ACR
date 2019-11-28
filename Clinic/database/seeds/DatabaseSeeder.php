<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersTableSeeder::class,
             ClientsTableSeeder::class,
             MedicsTableSeeder::class,
             AppointmentsTableSeeder::class,
             EmployeesTableSeeder::class,
             FaqsTableSeeder::class,
             AnalysisTableSeeder::class,
             SpecialtysTableSeeder:: class,
             StatesTableSeeder::class
                 ]);

    }
}
