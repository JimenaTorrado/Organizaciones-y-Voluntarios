<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\OrganizationVolunteer;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrganizationVolunteer>
 */
class OrganizationVolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'volunteer_id'    => Volunteer::factory(),
            'join_date'       => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'role'            => $this->faker->randomElement(OrganizationVolunteer::ROLES),
            'registered_by'   => (string) (User::query()->value('id') ?? 1),
        ];
    }
}
