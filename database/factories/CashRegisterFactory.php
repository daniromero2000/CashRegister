<?php
/** @var Factory $factory */

use App\Entities\CashRegisters\CashRegister;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(CashRegister::class, function (Faker $faker) {
    return [
        'denomination' => $faker->randomElement(['bill', 'coin']),
        'value'        => $faker->randomElement([100000, 50000, 20000, 10000, 5000, 1000, 500, 200, 100, 50]),
        'quantity'     => $faker->numberBetween(1, 5)
    ];
});
