<?php

use Faker\Generator as Faker;

$factory->define(App\Track::class, function (Faker $faker) {
    $startDate = now()->startOfWeek();
    $endDate = now()->endOfWeek();
    return [
        'title' => $faker->word,
        'artist_id' => function(){
            return App\User::all()->random();
        },
        'genre' => $faker->word,
        'track' => 'track_' . rand(1,3) . '.wav',
        'created_at' => $faker->DateTimeBetween($startDate, $endDate),
    ];
});



$factory->state(App\Feature::class, 'track', function (Faker $faker) {
    return [
        'feature_type' => 'App\Track',
        'feature_id' => function(){
            return App\Track::all()->random();
        },
    ];
});
