<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'    => $this->faker->firstName(),
            'last_name'     => $this->faker->lastName(),
            'phone'         => $this->faker->phoneNumber(),
            'email'         => $this->faker->unique()->safeEmail(),
            'city'          => $this->faker->city(),
            'birth_date'    => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'status'        => true,
            'registered_by' => User::factory(),
        ];
    }
}
