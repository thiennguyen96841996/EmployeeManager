<?php

use Illuminate\Database\Seeder;

class AttendtionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Attendtion::class, 10)->create();
    }
}
