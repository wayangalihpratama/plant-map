<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AreaTree;
use Faker\Generator as Faker;

$factory->define(
    AreaTree::class, function (Faker $faker) {
        return [
            'tree_id' => null,
            'area_id' => null,
            'age' => $faker->numberBetween($min = 1, $max = 53)
        ];
    }
);
