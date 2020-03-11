<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $ids = Category::whereIsLeaf()
        ->get()
        ->pluck('id');

    return [
        'name' => $faker->sentence(2, true),
        'price' => rand(1, 999),
        'category_id' => (int) $ids->random(),
        'description' => $faker->text(500),
    ];
});
