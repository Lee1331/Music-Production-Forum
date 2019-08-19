<?php

use Faker\Generator as Faker;

$factory->define(App\ForumCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
