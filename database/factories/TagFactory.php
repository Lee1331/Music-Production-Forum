<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $startDate = '-1 year';
    $endDate = 'now';
    return [
        'name' => $faker->unique()->word,
        'created_at' => $faker->DateTimeBetween($startDate, $endDate),
    ];
});
