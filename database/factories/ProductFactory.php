<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\SubCategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $ids = SubCategory::all()
        ->pluck('id');

    return [
        'name' => $faker->name,
        'price' => rand(1, 999999),
        'sub_category_id' => (int) $ids->random(),
        'description' => $faker->text(500),
    ];
});
