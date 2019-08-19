<?php

use Faker\Generator as Faker;

$factory->define(App\ForumThread::class, function (Faker $faker) {
    $user_ids = \DB::table('users')->select('id')->get();
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'view_count' => rand(0,100),
        'user_id' => function(){
            return App\User::all()->random();
        },
        'category_id' => function(){
            return App\ForumCategory::all()->random();
        },
        'created_at' => $faker->DateTimeBetween($startDate = '-1 year', $endDate = 'now'),
    ];
});
