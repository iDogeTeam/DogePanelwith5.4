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
		'name'           => $faker->name,
		'email'          => $faker->unique()->safeEmail,
		'password'       => $password ? : $password = bcrypt('secret'),
		'remember_token' => str_random(10),
		'register_ip'    => $faker->ipv4,
	];
});

// Services
$factory->define(App\UserService::class, function (Faker\Generator $faker) {
	static $user_id;
	static $group_id;

	return [
		'user_id'  => $user_id ? : $faker->shuffle(range(1, 10))[0],
		'group_id' => $group_id ? : $faker->shuffle(range(1, 10))[0],
		'type'     => 'shadowsocks',
		'password' => str_random(10),
		'port'     => $faker->unique()->shuffle(range(10001, 10100))[0],
		'method'   => 'aes-256-cfb',
	];
});

// Node
$factory->define(App\Node::class, function (Faker\Generator $faker) {
	static $group_id;

	return [
		'name'       => $faker->name,
		'type'       => 'shadowsocks',
		'group_id'   => $group_id ? : $faker->shuffle(range(1, 10))[0],
		'token'      => str_random(10),
		'ip_address' => $faker->ipv4,
	];
});

// NodeGroup
$factory->define(App\NodeGroup::class, function (Faker\Generator $faker) {

	return [
		'name'        => $faker->name,
		'description' => $faker->paragraphs[0],
	];
});

// TrafficLog
$factory->define(App\TrafficLog::class, function (Faker\Generator $faker) {
	static $service_id;
	static $node_id;

	return [
		'service_id' => $service_id ? : $faker->shuffle(range(1, 100))[0],
		'node_id'    => $node_id ? : $faker->shuffle(range(1, 100))[0],
		'download'   => $faker->numberBetween(1000, 100000000000),
		'upload'     => $faker->numberBetween(1000, 1000000000000),
	];
});

// ItemLog

$factory->define(App\ItemLog::class, function (Faker\Generator $faker) {
	static $user_id;
	static $item_id;

	return [
		'user_id' => $user_id ? : $faker->shuffle(range(1, 100))[0],
		'item_id' => $item_id ? : $faker->shuffle(range(1, 100))[0],
		'action'  => $faker->boolean(10) ? 'create' : 'used',
	];
});


// ItemLog

$factory->define(App\UserLevel::class, function (Faker\Generator $faker) {
	static $level;
	static $amount;
	static $shadowsocks;
	static $anyconnnect;

	return [
		'level'       => $level,
		'amount'      => $amount,
		'shadowsocks' => $shadowsocks,
		'anyconnect'  => $anyconnnect,
	];
});