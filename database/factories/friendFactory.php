<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Friend::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,10),
        'friend_id'=>rand(1,10),
    ];
});
