<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $date = \Carbon\Carbon::now();
    return [
        'title' => $faker->jobTitle,
        'trouble_type' => $faker->randomElement(['1', '2', '3', '4', '5']),
        'insurance_target' => $faker->numberBetween(1, 9),
        'trouble_content' => $faker->sentence,
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        }
        
    ];
});
