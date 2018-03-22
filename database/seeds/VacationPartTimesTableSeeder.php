<?php

use Illuminate\Database\Seeder;

class VacationPartTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\VacationParttime::class, 10)->create();
    }
}
