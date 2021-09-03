<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Andar extends Model
{
    use HasFactory;

    protected $table = "andar";
    protected $fillable = [

        'id',
        'nome',
    ];
}
