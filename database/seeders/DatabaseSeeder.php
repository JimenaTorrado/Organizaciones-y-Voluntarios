<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationVolunteer;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $organizations = Organization::factory(8)->create(['registered_by' => $user->id]);

        // cada voluntario queda vinculado a entre 1 y 3 organizaciones al azar
        Volunteer::factory(25)->create(['registered_by' => $user->id])
            ->each(function (Volunteer $volunteer) use ($organizations, $user) {
                $volunteer->organizations()->attach($organizations->random(rand(1, 3))->pluck('id'), [
                    'join_date'     => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                    'role'          => fake()->randomElement(OrganizationVolunteer::ROLES),
                    'registered_by' => $user->id,
                ]);
            });
    }
}
