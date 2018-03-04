<?php

use Faker\Generator as Faker;

$factory->define(App\Advertiser::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
