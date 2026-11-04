<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => $this->faker->company(),
            'description'   => $this->faker->optional()->paragraph(),
            'type'          => $this->faker->randomElement(['ONG', 'Fundación', 'Asociación', 'Corporación', 'Grupo comunitario']),
            'phone'         => $this->faker->phoneNumber(),
            'email'         => $this->faker->unique()->safeEmail(),
            'address'       => $this->faker->address(),
            'city'          => $this->faker->city(),
            'creation_date' => $this->faker->dateTimeBetween('-20 years', 'now')->format('Y-m-d'),
            'status'        => $this->faker->boolean(80),
            'registered_by' => (string) (User::query()->value('id') ?? 1),
        ];
    }
}
