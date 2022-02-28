<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Incidente;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Incidente::class, function (Faker $faker) {
    return [
        'tipo_incidente' => Str::random(10),
        'nombre_incidente' => Str::random(10),
    ];
});

