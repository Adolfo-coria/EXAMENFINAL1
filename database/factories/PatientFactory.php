<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'ci' => $this->faker->unique()->numerify('########'),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->randomElement(['male','female','other']),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'medical_history' => $this->faker->optional()->text(200),
            'status' => 'active',
        ];
    }
}
