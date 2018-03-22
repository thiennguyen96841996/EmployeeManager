<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Overtime::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'start_time' => $faker->time($format = 'H:i:s', $max = '10:00:00'),
        'end_time' => $faker->time($format = 'H:i:s', $min = '13:00:00'),
        'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
