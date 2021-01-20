<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->unique()->sentence,
    ];
});
