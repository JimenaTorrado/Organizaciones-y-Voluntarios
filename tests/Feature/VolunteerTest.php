<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Volunteer;

function volunteerData(array $overrides = []): array
{
    return array_merge([
        'first_name' => 'Ana',
        'last_name'  => 'Pérez',
        'phone'      => '3109876543',
        'email'      => 'ana@example.com',
        'city'       => 'Bucaramanga',
        'birth_date' => '1995-03-15',
    ], $overrides);
}

test('un invitado no puede ver los voluntarios', function () {
    $this->get(route('volunteers.index'))->assertRedirect(route('login'));
});

test('al crear un voluntario se vincula a las organizaciones marcadas', function () {
    $user          = User::factory()->create();
    $organizations = Organization::factory(2)->create();

    $this->actingAs($user)
        ->post(route('volunteers.store'), volunteerData(['organizations' => $organizations->pluck('id')->all()]))
        ->assertRedirect(route('volunteers.index'));

    $volunteer = Volunteer::where('email', 'ana@example.com')->firstOrFail();

    expect($volunteer->organizations)->toHaveCount(2)
        ->and($volunteer->organizations->first()->pivot->role)->toBe('Voluntario')
        ->and($volunteer->registered_by)->toBe($user->id);
});

test('la fecha de nacimiento debe ser anterior a hoy', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('volunteers.store'), volunteerData(['birth_date' => now()->addDay()->toDateString()]))
        ->assertSessionHasErrors('birth_date');
});

test('al editar se quitan las desmarcadas y se conserva el rol de las que siguen', function () {
    $user                  = User::factory()->create();
    $volunteer             = Volunteer::factory()->create(['email' => 'ana@example.com']);
    [$sigue, $quita, $nueva] = Organization::factory(3)->create();

    $volunteer->organizations()->attach($sigue, ['join_date' => '2024-01-01', 'role' => 'Coordinador', 'registered_by' => $user->id]);
    $volunteer->organizations()->attach($quita, ['join_date' => '2024-01-01', 'role' => 'Voluntario', 'registered_by' => $user->id]);

    $this->actingAs($user)
        ->put(route('volunteers.update', $volunteer), volunteerData(['organizations' => [$sigue->id, $nueva->id]]))
        ->assertRedirect(route('volunteers.index'));

    $vinculadas = $volunteer->organizations()->get()->keyBy('id');

    expect($vinculadas->keys()->sort()->values()->all())->toBe([$sigue->id, $nueva->id])
        ->and($vinculadas[$sigue->id]->pivot->role)->toBe('Coordinador')
        ->and($vinculadas[$nueva->id]->pivot->role)->toBe('Voluntario');
});

test('al eliminar un voluntario se borran sus vínculos', function () {
    $volunteer = Volunteer::factory()->create();
    $volunteer->organizations()->attach(Organization::factory()->create(), [
        'join_date'     => now()->toDateString(),
        'role'          => 'Voluntario',
        'registered_by' => User::factory()->create()->id,
    ]);

    $this->actingAs(User::factory()->create())
        ->delete(route('volunteers.destroy', $volunteer))
        ->assertRedirect(route('volunteers.index'));

    $this->assertDatabaseCount('volunteers', 0);
    $this->assertDatabaseCount('organization_volunteer', 0);
});
