<?php
/** @var Factory $factory */

use App\Entities\TransactionLogs\TransactionLog;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(TransactionLog::class, function (Faker $faker) {
    return [
        'type'  => 'load_base',
        'value' => $faker->randomElement([100000, 50000, 20000, 10000, 5000, 1000, 500, 200, 100, 50]),
    ];
});
