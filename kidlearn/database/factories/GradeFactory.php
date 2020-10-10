<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'grade' => $faker->numberBetween(1, 10),
        'student_id' => $faker->numberBetween(20, 40),
        'class_subject_id' => $faker->numberBetween(1, 2),
        'comment' => $faker->colorName,
        'semester' => $faker->numberBetween(1, 2)

    ];
});
