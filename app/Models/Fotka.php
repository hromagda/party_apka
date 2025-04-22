<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fotka extends Model
{
    use HasFactory;
    /**
     * Určuje název tabulky, kterou tento model používá.
     *
     * V tomto případě se model vztahuje na tabulku 'fotky' v databázi.
     *
     * @var string
     */
    protected $table = 'fotky';

    /**
     * Určuje, které atributy modelu mohou být hromadně přiřazeny.
     *
     * Pomocí tohoto pole lze určovat, které sloupce mohou být bezpečně
     * přiřazeny pomocí metody create nebo při hromadném přiřazení (mass assignment).
     * V tomto případě jsou to sloupce 'nazev_souboru' a 'puvodni_nazev'.
     *
     * @var array
     */
    protected $fillable = ['nazev_souboru', 'puvodni_nazev'];
}
