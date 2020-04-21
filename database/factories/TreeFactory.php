<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tree;
use Faker\Generator as Faker;

$factory->define(
    Tree::class, function (Faker $faker) {
        return [
            'name' => null,
            'type_id' => null
        ];
    }
);
