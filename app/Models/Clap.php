<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clap extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "claps";
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
        'productivo',
        'tipo_produccion',
        'detalles_produccion',
        'num_familias',
        'num_lideres',
        'import_id',
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
        return $this->belongsTo(Parametro::class, 'bloques_id', 'id');
    }

    public function lideres()
    {
        return $this->hasMany(Lider::class, 'claps_id', 'id');
    }

    public function censo()
    {
        return $this->hasMany(Censo::class, 'claps_id', 'id');
    }

}
