<?php

use Faker\Generator as Faker;

$factory->define(App\Models\VacationFulltime::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'reason' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'status' => $faker->numberBetween($min = 0, $max = 2),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
