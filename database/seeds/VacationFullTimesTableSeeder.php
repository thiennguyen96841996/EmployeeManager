<?php

use Illuminate\Database\Seeder;

class VacationFullTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\VacationFulltime::class, 10)->create();
    }
}
