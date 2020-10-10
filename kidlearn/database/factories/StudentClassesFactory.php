<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\StudentClasses;
use Faker\Generator as Faker;

$factory->define(StudentClasses::class, function (Faker $faker) {
    return [
        'year' => $faker->numberBetween(9, 12),
        'label' => $faker->randomLetter
    ];
});
