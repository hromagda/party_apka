<?php

use App\Models\Fotka;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('admin může smazat fotku', function () {
    // ✅ Nejdřív vytvoříme roli
    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $fotka = Fotka::factory()->create();

    $this->actingAs($admin)
        ->delete("/admin/fotky/{$fotka->id}")
        ->assertRedirect();

    $this->assertDatabaseMissing('fotky', ['id' => $fotka->id]);
});
