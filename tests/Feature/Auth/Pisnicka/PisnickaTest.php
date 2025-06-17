<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pisnicka;

uses(RefreshDatabase::class);

test('host může přidat písničku', function () {
    $response = $this->post('/pisnicky', [
        'interpret' => 'Kabát',
        'nazev' => 'Burlaci',
        'objednavatel' => 'Aneta',
    ]);

    $response->assertRedirect(); // přesměrování po odeslání
    $this->assertDatabaseHas('pisnicky', [
        'interpret' => 'Kabát',
        'nazev' => 'Burlaci',
        'objednavatel' => 'Aneta',
    ]);
});
