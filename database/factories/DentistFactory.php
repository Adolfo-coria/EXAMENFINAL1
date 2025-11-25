<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dentist>
 */
class DentistFactory extends Factory
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
            'license_number' => $this->faker->unique()->bothify('LIC-#####'),
            'specialization' => $this->faker->randomElement(['Ortodoncia','Endodoncia','Implantes','Odontopediatría','Periodoncia']),
            'biography' => $this->faker->optional()->text(150),
            'office_location' => $this->faker->address(),
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'status' => 'active',
        ];
    }
}
