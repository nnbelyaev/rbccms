<?php

use Faker\Generator as Faker;

$factory->define(App\Publication::class, function (Faker $faker) {
    $faker->locale('ru_RU');
    return [
        'type' => $faker->randomElement(['news','analytics','interview','opinion','gallery','video','digests','anons','curious','card','test','poll','afisha']),
        'office' => $faker->randomElement(['news','daily','styler','lite']),
        'status' => 'normal',
        'dtpub' => $faker->dateTimeBetween('-1 year'),
        'rubric_id' => rand(1,50),
        'region_id' => 0,
        'story_id' => 0,
        'ukrnet_id' => 0,
        'color' => 0,
        'bold' => false,
        'exclusive' => false,
        'has_photo' => false,
        'has_video' => false,
        'maindomain' => false,
        'webpush' => false,
        'webpush_sended' => false,
        'image' => '',
        'extra' => '{}',
        'tags' => '{}',
        'readalso' => '{}',
        'authors' => '{}',
        'editor_id' => 0,
        'corrector_id' => 0,
        'locked' => 0,
        'prefix' => '',
        'heading' => $faker->sentence(),
        'lead' => $faker->paragraph(),
        'text' => $faker->realText(),
        'title' => $faker->sentence(),
        'title_extra' => '{}',
        'keywords' => $faker->sentence(),
        'description' => $faker->sentence(),
        'heading:ua' => $faker->sentence(),
        'lead:ua' => $faker->paragraph(),
        'text:ua' => $faker->realText(),
        'title:ua' => $faker->sentence(),
        'title_extra:ua' => '{}',
        'keywords:ua' => $faker->sentence(),
        'description:ua' => $faker->sentence(),
    ];
});
