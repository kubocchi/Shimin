<?php

use Faker\Generator as Faker;

$factory->define(App\ActiveCenter::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now') ,
        'end_date' => $faker->date($format = 'Y-m-d', $max = 'now') ,
        'content' => $faker->text(30),
        'file' =>'3243242',
        'deactivate'=> $faker->numberBetween(0, 1),
        'created_by'=> $faker->randomDigit,
        'updated_by'=> $faker->randomDigit
    ];
});
