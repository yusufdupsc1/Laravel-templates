<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'grade' => $this->faker->randomElement(['9 STEM', '10 STEM', '11 Arts', '12 Science', '12 Commerce']),
            'gpa' => $this->faker->randomFloat(2, 2.5, 4),
            'status' => $this->faker->randomElement(['Active', 'Watch', 'New']),
            'guardian' => $this->faker->name(),
            'contact' => $this->faker->e164PhoneNumber(),
        ];
    }
}
