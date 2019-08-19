<?php

use Faker\Generator as Faker;

$factory->define(App\LikeForumPost::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return App\User::all()->random();
        },
        'forum_post_id' => function(){
            return App\ForumPost::all()->random();
        },
    ];
});
