<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proteico extends Model
{
    use HasFactory;
    protected $table = "plan_proteico";
    protected $fillable = [
        'fecha',
        'municipios_id',
        'parroquias_id',
        'familias',
        'tm',
        'parametros_id',
        'rubros',
        'band'
    ];

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipios_id', 'id');
    }

    public function parroquias()
    {
        return $this->belongsTo(Parroquia::class, 'parroquias_id', 'id');
    }

    public function parametros()
    {
        return $this->belongsTo(Parametro::class, 'parametros_id', 'id');
    }

}
