<?php
/** @var Factory $factory */

use App\Entities\CashRegisters\CashRegister;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;


$factory->define(CashRegister::class, function (Faker $faker) {
    return [
        'denomination' => 'bill',
        'value' => '50000',
        'quantity' => 1
    ];
});
