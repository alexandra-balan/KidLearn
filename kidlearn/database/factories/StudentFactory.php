<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'class_id' => $faker->numberBetween(1, 4),
        'user_id' => $faker->numberBetween(5, 8)

    ];
});
