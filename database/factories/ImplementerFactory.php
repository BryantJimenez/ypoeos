<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Implementer;
use Faker\Generator as Faker;

$factory->define(Implementer::class, function (Faker $faker) {
	$experience="<p>".$faker->paragraph(6)."</p>";
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
        'lat' => $faker->latitude(34.53371242139567, 48.05605376398125),
        'lng' => $faker->longitude(-78.04687500000001, -121.99218750000001),
        'experience' => $experience,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'linkedin' => $linkedin,
        'user_id' => $faker->unique()->numberBetween(2, 101)
    ];
});
