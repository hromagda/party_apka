<?php

use App\Models\User;
use App\Models\Pisnicka;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;

uses(RefreshDatabase::class);

test('DJ může označit písničku jako zahranou', function () {

    // Vymaže cache přiřazených rolí a oprávnění
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    Role::create(['name' => 'dj']);
    Permission::create(['name' => 'označit píseň jako zahranou']); // <- přidej, pokud máš oprávnění

// přiřazení oprávnění roli
    Role::findByName('dj')->givePermissionTo('označit píseň jako zahranou');

    $dj = User::factory()->create();
    $dj->assignRole('dj');

    $pisnicka = Pisnicka::factory()->create(['zahrano' => false]);

    $this->actingAs($dj)
        ->patch("/pisnicky/{$pisnicka->id}/zahrano")
        ->assertRedirect();

    $this->assertDatabaseHas('pisnicky', [
        'id' => $pisnicka->id,
        'zahrano' => true,
    ]);
});
