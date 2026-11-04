<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Volunteer;

function organizationData(array $overrides = []): array
{
    return array_merge([
        'name'          => 'Fundación Manos Unidas',
        'type'          => 'Fundación',
        'phone'         => '3001234567',
        'email'         => 'contacto@manosunidas.org',
        'address'       => 'Calle 10 # 20-30',
        'city'          => 'Bucaramanga',
        'creation_date' => '2020-05-10',
    ], $overrides);
}

test('un invitado no puede ver las organizaciones', function () {
    $this->get(route('organizations.index'))->assertRedirect(route('login'));
});

test('el listado muestra las organizaciones', function () {
    $organization = Organization::factory()->create();

    $this->actingAs(User::factory()->create())
        ->get(route('organizations.index'))
        ->assertOk()
        ->assertSee($organization->name);
});

test('un usuario puede crear una organización', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('organizations.store'), organizationData())
        ->assertRedirect(route('organizations.index'));

    $this->assertDatabaseHas('organizations', [
        'email'         => 'contacto@manosunidas.org',
        'registered_by' => $user->id,
    ]);
});

test('no se puede repetir el correo de otra organización', function () {
    Organization::factory()->create(['email' => 'contacto@manosunidas.org']);

    $this->actingAs(User::factory()->create())
        ->post(route('organizations.store'), organizationData())
        ->assertSessionHasErrors('email');
});

test('al editar se puede conservar el mismo correo', function () {
    $organization = Organization::factory()->create(['email' => 'contacto@manosunidas.org']);

    $this->actingAs(User::factory()->create())
        ->put(route('organizations.update', $organization), organizationData(['name' => 'Nuevo nombre']))
        ->assertSessionHasNoErrors();

    expect($organization->fresh()->name)->toBe('Nuevo nombre');
});

test('se puede vincular un voluntario una sola vez', function () {
    $organization = Organization::factory()->create();
    $volunteer    = Volunteer::factory()->create();
    $datos        = ['volunteer_id' => $volunteer->id, 'role' => 'Coordinador'];

    $this->actingAs(User::factory()->create());

    $this->post(route('organizations.vincular', $organization), $datos)->assertSessionHas('success');
    $this->post(route('organizations.vincular', $organization), $datos)->assertSessionHas('error');

    expect($organization->volunteers()->count())->toBe(1)
        ->and($organization->volunteers()->first()->pivot->role)->toBe('Coordinador');
});

test('al eliminar una organización se borran sus vínculos', function () {
    $organization = Organization::factory()->create();
    $organization->volunteers()->attach(Volunteer::factory()->create(), [
        'join_date'     => now()->toDateString(),
        'role'          => 'Voluntario',
        'registered_by' => User::factory()->create()->id,
    ]);

    $this->actingAs(User::factory()->create())
        ->delete(route('organizations.destroy', $organization))
        ->assertRedirect(route('organizations.index'));

    $this->assertDatabaseCount('organizations', 0);
    $this->assertDatabaseCount('organization_volunteer', 0);
});
