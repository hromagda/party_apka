<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vzkaz extends Model
{
    /**
     * Určuje název tabulky, která bude použita pro tento model.
     * V tomto případě je to tabulka 'vzkazy'.
     *
     * @var string
     */
    protected $table = 'vzkazy';

    /**
     * Atributy, které mohou být hromadně přiřazeny.
     *
     * Tento seznam určuje, které sloupce tabulky mohou být
     * automaticky přiřazeny pomocí hromadného přiřazení (mass assignment).
     * V tomto případě jsou to sloupce 'jmeno' a 'text'.
     *
     * @var list<string>
     */
    protected $fillable = ['jmeno', 'text'];
}
