<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Testimonial;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Testimonial::class, function (Faker $faker) {
	$name=$faker->unique()->name;
	$slug=Str::slug('testimonial '.$name, '-');
    return [
        'slug' => $slug,
        'name' => $name,
        'title' => $faker->jobTitle,
        'testimonial' => $faker->paragraph,
        'implementer_id' => $faker->numberBetween(1, 100)
    ];
});
