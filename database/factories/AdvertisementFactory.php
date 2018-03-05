<?php

use Faker\Generator as Faker;

$factory->define(App\Advertisement::class, function (Faker $faker) {
    return [
        'advertiser_id' => function () {
            return factory(App\Advertiser::class)->create()->id;
        },
        'status' => 1,
        'title' => $faker->title,
        'body' => $faker->text,
        'price' => $faker->NumberBetween(1000, 10000),
    ];
});
