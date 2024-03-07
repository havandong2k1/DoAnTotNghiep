<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'admin_name' => fake()->name(),
        'admin_email' => fake()->unique()->safeEmail(),
        'admin_phone' => '0923100330',
        'admin_password' => '202cb962ac59075b964b07152d234b70', // password    
    ];
});