<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportClap extends Model
{
    use HasFactory;
    protected $table = "import_claps";
    protected $fillable = [
        'nombre_clap',
        'programa',
        'municipios_id',
        'parroquias_id',
        'comunidad',
        'codigo_spda',
        'codigo_sica',
        'bloques_id',
        'cedula_lider',
        'primer_nombre_lider',
        'segundo_nombre_lider',
        'primer_apellido_lider',
        'segundo_apellido_lider',
        'nacionalidad_lider',
        'genero',
        'fecha_nac_lider',
        'profesion_lider',
        'trabajo_lider',
        'telefono_1_lider',
        'telefono_2_lider',
        'email_lider',
        'estatus_lider',
        'direccion',
        'longitud',
        'latitud',
        'google_maps',
        'observaciones',
        'import_id'
    ];

    public function parametros()
    {
        return $this->belongsTo(Parametro::class, 'import_id', 'id');
    }

}
