<?php

use Faker\Generator as Faker;

$factory->define(App\ArticleTag::class, function (Faker $faker) {
    return [
        'article_id' => function(){
            return App\Article::all()->random();
        },
        'tag_id' => function(){
            return App\Tag::all()->random();
        },
    ];
});
