<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Censo extends Model
{
    use HasFactory;
    protected $table = "censo";
    protected $fillable = ['claps_id', 'num_familia', 'miembro_familia', 'nombre_completo', 'tipo_ci', 'cedula', 'telefono_1',
        'telefono_2', 'estructura_clap', 'email', 'direccion', 'lideres_id', 'cdlp', 'observaciones', 'municipios_id', 'parroquias_id'];

    public function claps()
    {
        return $this->belongsTo(Clap::class, 'claps_id', 'id');
    }

    public function lider()
    {
        return $this->belongsTo(Lider::class, 'lideres_id', 'id');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipios_id', 'id');
    }

    public function parroquias()
    {
        return $this->belongsTo(Parroquia::class, 'parroquias_id', 'id');
    }

}
