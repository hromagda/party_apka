<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotka extends Model
{
    protected $table = 'fotky';
    protected $fillable = ['nazev_souboru', 'puvodni_nazev'];
}
