<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'screen_name'    => $faker->userName,
        'name'           => $faker->name,
        'description'    => $faker->realText($faker->numberBetween(100, 200)),
        'email'          => Str::random(10).'@example.com',
        'password'       => $faker->unique()->password,
        'remember_token' => Str::random(10),
        'created_at'     => now(),
        'updated_at'     => now()
    ];
});
