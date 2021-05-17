<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisica extends Model
{
    use HasFactory;
    protected $table = "tienda_fisica";
    protected $fillable = [
        'fecha',
        'parametros_id',
        'familias',
        'tm',
        'band'
    ];

    public function parametros()
    {
        return $this->belongsTo(Parametro::class, 'parametros_id', 'id');
    }
}
