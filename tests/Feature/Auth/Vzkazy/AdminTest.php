<?php


use App\Models\Vzkaz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('admin může smazat vzkaz', function () {

    // ✅ Nejdřív vytvoříme roli
    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $vzkaz = Vzkaz::factory()->create();

    $this->actingAs($admin)
        ->delete("/admin/vzkazy/{$vzkaz->id}")
        ->assertRedirect();

    $this->assertDatabaseMissing('vzkazy', ['id' => $vzkaz->id]);
});
