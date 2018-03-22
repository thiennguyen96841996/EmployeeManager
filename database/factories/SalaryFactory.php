<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Salary::class, function (Faker $faker) {
	$basic_salary = $faker->randomFloat($nbMaxDecimals = NULL, $min = 2000, $max = 3000);
    $overtime_salary = $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 30);
    $insurance_money = $faker->randomFloat($nbMaxDecimals = NULL, $min = 50, $max = 100);
    $insurance_payment = $faker->randomFloat($nbMaxDecimals = NULL, $min = 50, $max = 100);
    $real_salary = $basic_salary - $insurance_money;
    return [
        'basic_salary' => $basic_salary,
        'overtime_salary' => $overtime_salary,
        'insurance_money' => $insurance_money,
        'insurance_payment' => $insurance_payment,
        'real_salary' => $real_salary,
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
