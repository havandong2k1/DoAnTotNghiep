<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;

use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'admin_name' => fake()->name(),
            'admin_email' => fake()->unique()->safeEmail(),
            'admin_phone' => '0923100330',
            'admin_password' => '202cb962ac59075b964b07152d234b70', // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}   

// $factory->define(App\Models\Admin::class, function(Faker $faker){
//     return[
//         'admin_name' => fake()->name(),
//         'admin_email' => fake()->unique()->safeEmail(),
//         'admin_phone' => '0923100330',
//         'admin_password' => '202cb962ac59075b964b07152d234b70', // password

//     ];
// });


// $factory->afterCreating(Admin::class, function($admin, $faker){
//     $roles = Roles::where('name', 'user')->get();
//     $admin->roles()->sync($roles->pluck('id_roles')->toArray());
// });