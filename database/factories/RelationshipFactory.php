<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Relationship::class, function (Faker $faker) {
    return [
		'follower_id' => $faker->numberBetween(1, 10),
		'followed_id' => $faker->numberBetween(1, 10),
    ];
});
