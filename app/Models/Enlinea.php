<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlinea extends Model
{
    use HasFactory;
    protected $table = "tienda_enlinea";
    protected $fillable = [
        'fecha',
        'parametros_id',
        'plataforma',
        'familias',
        'tm',
        'band'
    ];

    public function parametros()
    {
        return $this->belongsTo(Parametro::class, 'parametros_id', 'id');
    }
}
