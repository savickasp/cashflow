<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'owner_id' => factory(App\User::class)->create(),
        'name' => $faker->unique()->slug,
        'invite_code' => \Illuminate\Support\Str::random(8),
    ];
});
