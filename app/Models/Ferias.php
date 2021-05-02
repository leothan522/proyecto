<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferias extends Model
{
    use HasFactory;
    protected $table = "ferias_campo";
    protected $fillable = [
        'fecha',
        'municipios_id',
        'parroquias_id',
        'familias',
        'tm'
        ];
}
