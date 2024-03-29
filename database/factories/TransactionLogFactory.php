<?php
/** @var Factory $factory */

use App\Models\TransactionLog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(TransactionLog::class, function (Faker $faker) {
    return [
        'type'  => $faker->randomElement(['load_base', 'payment', 'cash_back']),
        'value' => $faker->randomElement([100000, 50000, 20000, 10000, 5000, 1000, 500, 200, 100, 50]),
    ];
});
