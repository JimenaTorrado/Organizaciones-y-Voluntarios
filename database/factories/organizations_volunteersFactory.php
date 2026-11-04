<?php

namespace Database\Factories;
use App\Models\Traveler;
use App\Models\Destination;
use App\Models\TravelerDestination;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Model>
 */
class organizations_volunteersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'organization_id' => Organization::inRandomOrder()->first()?->id ?? Organization::factory()->create()->id,

        'volunteer_id' => Volunteer::inRandomOrder()->first()?->id ?? Volunteer::factory()->create()->id,

        'joined_at' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),

        'role' => $this->faker->randomElement([
            'Volunteer',
            'Coordinator',
            'Assistant',
            'Administrator'
        ]),
    ];
    }
}
