<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Implementer;
use Faker\Generator as Faker;

$factory->define(Implementer::class, function (Faker $faker) {
	$facebook=NULL;
	$twitter=NULL;
	$linkedin=NULL;
	if ($faker->boolean) {
		$facebook='https://facebook.com';
	}
	if ($faker->boolean) {
		$twitter='https://twitter.com';
	}
	if ($faker->boolean) {
		$linkedin='https://linkedin.com';
	}
    return [
        'title' => $faker->jobTitle,
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'experience' => $faker->paragraph,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'linkedin' => $linkedin,
        'user_id' => $faker->unique()->numberBetween(2, 101)
    ];
});
