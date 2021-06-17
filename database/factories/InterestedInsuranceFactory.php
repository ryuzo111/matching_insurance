<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;

$factory->define(App\Models\InterestedInsurance::class, function (Faker $faker) {
    return [
        'post_id' => function () {
            return factory(App\Models\Post::class);
            // return App\Models\Post::find($post->id);
        },
        'life' => $faker->numberBetween(0,1),
        'medical' => $faker->numberBetween(0,1),
        'cancer' => $faker->numberBetween(0,1),
        'pension' => $faker->numberBetween(0,1),
        'saving' => $faker->numberBetween(0,1),
        'all_life' => $faker->numberBetween(0,1),
        'home' => $faker->numberBetween(0,1),
        'other' => $faker->numberBetween(0,1),
    ];
    
});
