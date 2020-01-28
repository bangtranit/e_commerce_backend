<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Model\Product;
use App\Model\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        //
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'review' => $faker->paragraph,
        'star' => $faker->numberBetween(0, 5),
    ];
});
