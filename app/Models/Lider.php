<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    use HasFactory;
    protected $table = "lideres";
    protected $fillable = ['claps_id', 'nombre_completo', 'tipo_ci', 'cedula', 'import_id'];

    public function claps()
    {
        $this->belongsTo(Clap::class, 'claps_id', 'id');
    }

    public function censo()
    {
        return $this->hasMany(Censo::class, 'lideres_id', 'id');
    }

}
