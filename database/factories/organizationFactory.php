<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class organizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => $this->faker->company(),
        'description' => $this->faker->optional()->paragraph(),
        'type' => $this->faker->randomElement([
            'Hospital',
            'Clinic',
            'Medical Center',
            'Health Organization',
            'Laboratory'
        ]),
        'phone' => $this->faker->phoneNumber(),
        'email' => $this->faker->unique()->safeEmail(),
        'address' => $this->faker->optional()->address(),
        'city' => $this->faker->city(),
        'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        'status' => $this->faker->boolean(80), // 80% de probabilidad de ser true
    ];
}
    }

