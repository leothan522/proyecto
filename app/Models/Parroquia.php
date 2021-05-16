<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    use HasFactory;
    protected $table = "parroquias";
    protected $fillable = ['nombre_completo', 'nombre_corto', 'municipios_id'];

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'municipios_id', 'id');
    }

    public function claps()
    {
        return $this->hasMany(Clap::class, 'parroquias_id', 'id');
    }

    public function censo()
    {
        return $this->hasMany(Censo::class, 'municipios_id', 'id');
    }

	public function ferias()
    {
        return $this->hasMany(Ferias::class, 'parroquias_id', 'id');
    }

    public function movil()
    {
        return $this->hasMany(Movil::class, 'parroquias_id', 'id');
    }

}
