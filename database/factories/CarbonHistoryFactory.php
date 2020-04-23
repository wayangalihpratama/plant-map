<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CarbonHistory;
use Faker\Generator as Faker;

$factory->define(
    CarbonHistory::class, function (Faker $faker) {
        return [
            'area_tree_id' => null,
            'carbon' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 99),
            'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
        ];
    }
);
