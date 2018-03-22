<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Attention::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
