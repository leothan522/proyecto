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
        'tm',
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
		
}
