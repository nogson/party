<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Skill;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'label' => $faker->word(),
        'level' => $faker->numberBetween(1, 5),
    ];
});
