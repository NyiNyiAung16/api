<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'customer_id' => 'fw-' . $this->faker->randomNumber(4,true),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => fake()->password(),
            'image_url' => fake()->image(),
        ];
    }
}
