<?php

use Illuminate\Database\Seeder;

class OvertimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Overtime::class, 10)->create();
    }
}
