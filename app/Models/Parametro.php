<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;
    protected $table = "parametros";
    protected $fillable = ['nombre', 'tabla_id', 'valor'];

    public function municipios()
    {
        return $this->belongsTo(Municipio::class, 'tabla_id', 'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'valor', 'id');
    }

    public function imports()
    {
        return $this->hasMany(ImportClap::class, 'import_id', 'id');
    }

    public function claps()
    {
        return $this->hasMany(Clap::class, 'bloques_id', 'id');
    }

    public function periodos()
    {
        return $this->hasMany(Periodo::class, 'parametros_id', 'id');
    }

    public function fisica()
    {
        return $this->hasMany(Fisica::class, 'parametros_id', 'id');
    }

    public function enlinea()
    {
        return $this->hasMany(Enlinea::class, 'parametros_id', 'id');
    }

    public function proteico()
    {
        return $this->hasMany(Proteico::class, 'parametros_id', 'id');
    }

}
