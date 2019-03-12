<?php

use Faker\Generator as Faker;

$factory->define(App\Tournament::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'place' => $faker->text('50'),
        'start_date' =>$faker->date('Y-m-d','now')
    ];
});
