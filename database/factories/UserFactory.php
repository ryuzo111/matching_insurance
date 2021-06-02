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

$factory->define(App\Models\User::class, function (Faker $faker) {
    $age = rand(20, 100);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'image_pass' => $faker->imageUrl(),
        'age' => $age,
        'sex' => $faker->randomElement(['1', '2']),
        'insurance_company' => $faker->randomElement(['明治安田生命', '住友生命', 'Aflac']),
        'spouse' => $faker->randomElement(['0', '1']),
        'children' => $faker->numberBetween(0, 10),
        'house_type' => $faker->numberBetween(1, 7),
        'pref' => $faker->numberBetween(1, 47),
        'free_comment' => $faker->text,
    ];
});
