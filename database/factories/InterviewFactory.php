<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Interview::class, function (Faker $faker) {
    return [
        'candidate_id' => 1,
        'company_name' => $faker->name,
        'company_position' => $faker->title,
        'current_status' => $faker->boolean(50),
        'current_round' => $faker->buildingNumber, // secret
        'total_rounds' => $faker->randomNumber(),
    ];
});