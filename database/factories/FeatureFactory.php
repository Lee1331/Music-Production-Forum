<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Feature::class, function (Faker $faker) {

    return [

        'created_at' => now()->startOfWeek(),
    ];
});
