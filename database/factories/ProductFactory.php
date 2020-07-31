<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2),
        'description' => $faker->text,
    ];
});
