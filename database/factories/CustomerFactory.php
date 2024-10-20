<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'C_name' => $this->faker->name(),
            'C_email' => $this->faker->unique()->safeEmail(),
            'C_password' => Hash::make('password'), // Default password
            'C_Address' => $this->faker->address(),
        ];
    }
}
