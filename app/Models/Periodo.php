<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = "periodos";
    protected $fillable = ['parametros_id', 'municipios_id', 'fecha_atencion', 'tipo_entrega'];

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipios_id', 'id');
    }

    public function parametros()
    {
        return $this->belongsTo(Parametro::class, 'parametros_id', 'id');
    }

}
