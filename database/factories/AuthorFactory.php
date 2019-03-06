<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    return [
        'office' => $faker->randomElement(['daily','dailyoutside','styler','styleoutside']),
        'image' => '',
        'name' => $name,
        'regalia' => $faker->jobTitle,
        'dossie' => $faker->sentence(6),
        'name:ua' => $name,
        'regalia:ua' => $faker->jobTitle,
        'dossie:ua' => $faker->sentence(6),
    ];
});
