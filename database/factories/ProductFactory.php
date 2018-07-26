<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'quantity' => $faker->randomDigit(),
        'price' => $faker->randomDigit(),
    ];
});