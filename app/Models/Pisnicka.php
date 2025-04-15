<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pisnicka extends Model
{
    protected $table = 'pisnicky';
    protected $fillable = ['interpret', 'nazev', 'objednavatel'];
}
