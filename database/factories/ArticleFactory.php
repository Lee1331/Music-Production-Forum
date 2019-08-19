<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    $headerImage = 'Article_Header_Image_' . rand(4,6) . '.png';
    $bodyImage = 'Article_Body_Image_' . rand(1,3) . '.png';
    $startDate = now()->startOfWeek();
    $endDate = now()->endOfWeek();
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(rand(7,14), true),
        'excerpt' => $faker->paragraphs(rand(1,2), true),
        'author_id' => function(){
            return App\Admin::all()->random();
        },
        'header_image' => rand(0,1) == 1 ? $headerImage: NULL,
        'body_image' => rand(0,1) == 1 ? $bodyImage: NULL,
        'view_count' => rand(0,100),
        'created_at' => $faker->DateTimeBetween($startDate, $endDate),
    ];
});
$factory->state(App\Feature::class, 'article', function (Faker $faker) {
    return [
        'feature_type' => 'App\Article',
        'feature_id' => function(){
            return App\Article::all()->random();
        },
    ];
});
