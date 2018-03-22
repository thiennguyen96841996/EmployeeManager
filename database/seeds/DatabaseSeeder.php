<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);,
        $this->call([
        	AdminsTableSeeder::class,
        	UsersTableSeeder::class,
        	AttendtionsTableSeeder::class,
        	OvertimesTableSeeder::class,
        	ReportsTableSeeder::class,
        	SalariesTableSeeder::class,
        	VacationFullTimesTableSeeder::class,
        	VacationPartTimesTableSeeder::class,
        ]);
    }
}
