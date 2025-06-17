<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('písnička vyžaduje vyplněná pole', function () {
    $response = $this->post('/pisnicky', []);

    $response->assertSessionHasErrors(['interpret', 'nazev', 'objednavatel']);
});
