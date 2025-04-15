<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vzkaz extends Model
{
    protected $table = 'vzkazy';
    protected $fillable = ['jmeno', 'text'];
}
