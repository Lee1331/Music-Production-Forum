<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $image = 'User_image_' . rand(1,3) . '.png';
    $startDate = '-1 year';
    $endDate = 'now';
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->DateTimeBetween($startDate, $endDate),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'bio' => $faker->sentence,
        'profile_image' => rand(0,1) == 1 ? $image: NULL,
        'remember_token' => str_random(10),
        'created_at' => $faker->DateTimeBetween($startDate, $endDate),
    ];
});
