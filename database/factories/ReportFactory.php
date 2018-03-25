<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Report::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'today_content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'tomorrow_content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'problem' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
