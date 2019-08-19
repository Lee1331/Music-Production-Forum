<?php

use Faker\Generator as Faker;

$factory->define(App\ForumPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => function(){
            return App\User::all()->random();
        },
        'forum_thread_id' => function(){
            return App\ForumThread::all()->random();
        },
        'created_at' => $faker->DateTimeBetween($startDate = '-1 year', $endDate = 'now'),
    ];
});
