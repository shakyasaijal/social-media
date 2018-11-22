<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Message::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,5),
        'friend_id'=> rand(1,12),
        'message'=>$faker->realText(20)
    ];
});
