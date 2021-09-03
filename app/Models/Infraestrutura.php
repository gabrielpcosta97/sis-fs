<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraestrutura extends Model
{
    use HasFactory;

    protected $table = "infraestrutura";
    protected $fillable = [
        'id',
        'id_andar',
        'departamento',
        'nome_ambiente',
        'uso_principal',
        'ocupacao_maxima',
        'area',
        'epi',
        'insumos_solicitados',
        'insumos_recebidos',
        'saidas_ar',
        'classificacao',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];

    public function andar()
    {

        return $this->hasOne("App\Models\Andar", "id", "id_andar");
    }
}
