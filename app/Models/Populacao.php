<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Populacao extends Model
{
    use HasFactory;

    protected $table = 'populacao';
    protected $fillable = [

        'id',
        'topico',
        'valor',
        'created_at',
        'updated_at',

    ];
}
