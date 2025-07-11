<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customers::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(30),
            'phone' => $this->faker->sentence(15),
            'address' => $this->faker->sentence(100),
        ];
    }
}
