<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(\App\Entities\Invoice::class, function (Faker $faker) {
    $status = ['INIT', 'PAID', 'SUCCESS'];
    return [
        'price' => $faker->randomDigit,
        'user_id' => rand(1, 10),
        'service_id' => 1,
        'status' => $status[rand(0,2)],
    ];
});
