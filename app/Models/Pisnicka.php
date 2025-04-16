<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pisnicka extends Model
{
    protected $table = 'pisnicky';
    protected $fillable = ['interpret', 'nazev', 'objednavatel', 'zahrano'];

    public function getZahranoTextAttribute()
    {
        return $this->zahrano ? 'Zahráno' : 'Čeká ve frontě';
    }
}
