<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
		'family_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
		'password' => $faker->password,
		'pin' => '1234'
    ];
});

$factory->define(App\APIUser::class, function (Faker\Generator $faker) {
    return [
        'appToken' => str_random(10),
		'expiryDate' => '2018-10-01',
		'description' => 'test apiuser'
    ];
});