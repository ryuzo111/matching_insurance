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

$factory->define(App\Models\Good::class, function (Faker $faker) {
    $date = \Carbon\Carbon::now();
    return [
        'comment_id' => function () {
            return factory(App\Models\Comment::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
