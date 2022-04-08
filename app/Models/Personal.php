<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "personal";
    protected $fillable = [
        'cedula',
        'nombre_completo',
        'cargo',
        'ubicacion_geografica',
        'ubicacion_administrativa',
        'estatus',
        'foto_perfil'
    ];


}
