<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Clap;
use App\Models\Ferias;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use App\Models\Periodo;
use Illuminate\Http\Request;

class FeriasCampoController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipios = Municipio::orderBy('nombre_corto', 'ASC')->get();
        $municipios->each(function ($municipio) {
            $ferias = Ferias::where('fecha', 'LIKE', "%".date('Y')."%")->where('municipios_id', $municipio->id)->get();
            $municipio->ferias = $ferias->count();
            $municipio->familias = $ferias->sum('familias');
            $municipio->tm = $ferias->sum('tm');
        });

        $ferias = Ferias::where('fecha', 'LIKE', "%".date('Y')."%")->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');

        return view('android.ferias_campo.index')
            ->with('municipios', $municipios)
            ->with('total_ferias', $total_ferias)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ;
    }

	public function verMunicipio($id, $id_municipio)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);

        $parroquias = Parroquia::where('municipios_id', $id_municipio)->orderBy('nombre_completo', 'ASC')->get();
        $parroquias->each(function ($parroquia) {
            $ferias = Ferias::where('fecha', 'LIKE', "%".date('Y')."%")->where('parroquias_id', $parroquia->id)->get();
            $parroquia->ferias = $ferias->count();
            $parroquia->familias = $ferias->sum('familias');
            $parroquia->tm = $ferias->sum('tm');

        });

        $ferias = Ferias::where('fecha', 'LIKE', "%".date('Y')."%")->where('municipios_id', $id_municipio)->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');


        return view('android.ferias_campo.municipio')
            ->with('municipio', $municipio)
            ->with('parroquias', $parroquias)
            ->with('total_ferias', $total_ferias)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ;
    }

	public function verParroquia($id, $id_municipio, $id_parroquia)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);
        $parroquia = Parroquia::find($id_parroquia);
        $ferias = Ferias::where('fecha', 'LIKE', "%".date('Y')."%")->where('parroquias_id', $id_parroquia)->orderBy('fecha', 'ASC')->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');

        return view('android.ferias_campo.parroquia')
            ->with('municipio', $municipio)
            ->with('parroquia', $parroquia)
            ->with('total_ferias', $total_ferias)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ->with('ferias', $ferias)
            ->with('i', 0);
    }

}
