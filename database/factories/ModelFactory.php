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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
	    'register_ip' => $faker->ipv4,
    ];
});

// Services
$factory->define(App\UserService::class, function (Faker\Generator $faker){
	static $user_id;
	static $group_id;

	return [
		'user_id' => $user_id ?: $faker->shuffle(range(1,10))[0],
		'group_id' => $group_id ?: $faker->shuffle(range(1,10))[0],
		'type' => 'shadowsocks',
		'password' => str_random(10),
		'port' => $faker->unique()->shuffle(range(10001,10100))[0],
		'method' => 'aes-256-cfb',
	];
});
