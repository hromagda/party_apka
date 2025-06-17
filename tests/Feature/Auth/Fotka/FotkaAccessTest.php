<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Fotka;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('host nesmí smazat fotku', function () {
    $user = User::factory()->create(); // běžný uživatel bez role
    $fotka = Fotka::factory()->create();

    $response = $this->actingAs($user)
        ->delete("/admin/fotky/{$fotka->id}");

    $response->assertForbidden(); // očekáváme 403
});
