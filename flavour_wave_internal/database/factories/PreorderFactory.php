<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Preorder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preorder>
 */
class PreorderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Preorder::class;

    public function definition(): array
    {
        return [
            'user_id' =>User::factory(),
            'location' => fake()->sentence(),
            'delivered_quantity' => 20,
            'order_quantity'=> $this->faker->randomNumber(2,true)
        ];
    }
}
