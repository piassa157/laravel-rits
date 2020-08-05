<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Demanded;
use Faker\Generator as Faker;

$factory->define(Demanded::class, function (Faker $faker) {
    return [
        'status' => 'PENDENTE',
        'products_ids' => factory(App\Product::class),
        'user_id' => factory(App\User::class),
    ];
});
