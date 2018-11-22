<?php

use Faker\Generator as Faker;
$users = \App\User::pluck('id')->toArray();
$factory->define(\App\Models\Blog::class, function (Faker $faker) use ($users) {
    return [
        'title' => $faker->text(60),
        'slug' => str_slug($faker->text(60)),
        'posted_date' => $faker->date('Y-m-d h:i:s'),
        'description' => $faker->realText(600),
        'photo' => $faker->imageUrl(800, 400),
        'status' => 1,
        'user_id' => $users[count($users) - 1]
    ];
});
