<?php

use Faker\Generator as Faker;

$factory->define(App\PublicationTop::class, function (Faker $faker) {
    return [
        'list_id' => \App\Publication::LIST_TOP_PORTAL,
        'publication_id' => $faker->unique()->numberBetween(1, 5000),
        'position' => $faker->unique()->numberBetween(1, 5),
        'note' => ''
    ];
});
