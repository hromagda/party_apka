<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pisnicka extends Model
{

    use HasFactory;
    /**
     * Určuje název tabulky, kterou tento model používá.
     *
     * V tomto případě se model vztahuje na tabulku 'pisnicky' v databázi.
     *
     * @var string
     */
    protected $table = 'pisnicky';

    /**
     * Určuje, které atributy modelu mohou být hromadně přiřazeny.
     *
     * Pomocí tohoto pole lze určovat, které sloupce mohou být bezpečně
     * přiřazeny pomocí metody create nebo při hromadném přiřazení (mass assignment).
     * V tomto případě jsou to sloupce 'interpret', 'nazev', 'objednavatel' a 'zahrano'.
     *
     * @var array
     */
    protected $fillable = ['interpret', 'nazev', 'objednavatel', 'zahrano'];

    /**
     * Přístupový accessor pro atribut 'zahrano'.
     *
     * Tento accessor vrací textovou reprezentaci stavu písničky:
     * - Pokud je 'zahrano' true, vrací 'Zahráno'.
     * - Pokud je 'zahrano' false, vrací 'Čeká ve frontě'.
     *
     * @return string
     */
    public function getZahranoTextAttribute()
    {
        return $this->zahrano ? 'Zahráno' : 'Čeká ve frontě';
    }
}
