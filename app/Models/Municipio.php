<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //use HasFactory;
    protected $table = "municipios";
    protected $fillable =['nombre_completo', 'nombre_corto'];

    public function parroquias(){
        return $this->hasMany(Parroquia::class, 'municipios_id', 'id');
    }

    public function parametros(){
        return $this->hasMany(Parametro::class, 'tabla_id', 'id');
    }

}
