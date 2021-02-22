<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Implementer;
use Faker\Generator as Faker;

$factory->define(Implementer::class, function (Faker $faker) {
	$experience="<p>".$faker->paragraph(6)."</p>";
	$title=1;
	if ($faker->boolean) {
		$title=2;
	}
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
        'title' => $title,
        'ypo_chapter' => $faker->state,
        'service_area' => $faker->state,
        'address' => $faker->city,
        'lat' => $faker->latitude(34.53371242139567, 48.05605376398125),
        'lng' => $faker->longitude(-78.04687500000001, -121.99218750000001),
        'experience' => $experience,
        'ypo_link' => 'https://google.com',
        'eos_link' => NULL,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'linkedin' => $linkedin,
        'user_id' => $faker->unique()->numberBetween(2, 101)
    ];
});
