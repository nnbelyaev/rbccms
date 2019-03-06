<?php

use Faker\Generator as Faker;

$factory->define(App\Rubric::class, function (Faker $faker) {
    $faker->locale('ru');
    $city = $faker->unique()->city;
    return [
        'status' => 'normal',
        'category' => $faker->randomElement(['news', 'styler', 'afisha', 'lite', 'all']),

        'name' => $city,
        'h1' => $city,
        'title' => $city,
        'keywords' => $faker->sentence(6),
        'description' => $faker->sentence(6),

        'name:ua' => $city.'-ukr',
        'h1:ua' => $city.'-ukr',
        'title:ua' => $city.'-ukr',
        'keywords:ua' => $faker->sentence(6),
        'description:ua' => $faker->sentence(6),

        'banner_zone' => $faker->randomElement(['other', 'business']),
        'google_news' => $city,
        'subdomain' => $faker->randomElement([false, true]),
        'order' => rand(0,100)
    ];
});
