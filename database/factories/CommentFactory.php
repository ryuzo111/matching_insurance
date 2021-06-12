<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;

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

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    $date = \Carbon\Carbon::now();
    // return [
    //     'post_id' => function() {
    //         // return factory(App\Models\Post::class)->create()->id;
    //         return factory(App\Models\Post::class);
    //     },
    //     'user_id' => function () {
    //         // return factory(App\Models\User::class)->create()->id;
    //         return factory(App\Models\User::class);
    //     },
    //     'comment' => $faker->text,
    // ];

    $arr = [
        'post_id' => function() {
        // return factory(App\Models\Post::class)->create()->id;
        return factory(App\Models\Post::class);
    },
    'user_id' => function () {
        // return factory(App\Models\User::class)->create()->id;
        return factory(App\Models\User::class);
    },
    'comment' => $faker->text,
    ];

    Log::debug('commetnファクトリの中↓');
    Log::debug($arr);

    return $arr;
});
