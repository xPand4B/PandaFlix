<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Components\User\Database\User;
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
    $password = 'secret';

    return [
        // TODO: Add faker data
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'birthday' => $faker->date(),

        'password' => bcrypt($password),
        'api_token' => Str::random(),
        'remember_token' => Str::random(10),

        'email_verified_at' => now(),
    ];
});
