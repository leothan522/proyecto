<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Enlinea;
use App\Models\Fisica;
use App\Models\Movil;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiendaEnlineaController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipios = Parametro::where('nombre', 'tienda_enlinea')->orderBy('valor', 'ASC')->get();
        $municipios->each(function ($municipio) {
            $ferias = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")->where('parametros_id', $municipio->id)->get();
            //$municipio->ferias = $ferias->count();
            $municipio->familias = $ferias->sum('familias');
            $municipio->tm = $ferias->sum('tm');
            if ($municipio->valor == "AMBOS"){
                $municipio->plataformas = true;
            }else{
                $municipio->plataformas = false;
            }
        });

        $ferias = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');

        return view('android.tienda_enlinea.index')
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

        $municipio = Parametro::find($id_municipio);
        $parametros = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")->where('parametros_id', $id_municipio)->get();
        $ferias = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")
            ->where('parametros_id', $id_municipio)
            ->select(
                DB::raw('sum(familias) as familias'),
                DB::raw('sum(tm) as tm'),
                //DB::raw("DATE_FORMAT(fecha,'%m') as months")
                DB::raw("plataforma as plataforma")
            )
            ->groupBy('plataforma')
            ->get();

        $total_familias = $parametros->sum('familias');
        $total_tm = $parametros->sum('tm');

        //dd($ferias);
        return view('android.tienda_enlinea.municipio')
            ->with('municipio', $municipio)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ->with('ferias', $ferias)
            ;
    }

    public function verParroquia($id, $id_municipio, $id_parroquia)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Parametro::find($id_municipio);
        $parametros = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")->where('parametros_id', $id_municipio)->where('plataforma', $id_parroquia)->get();
        $ferias = Enlinea::where('fecha', 'LIKE', "%".date('Y')."%")
            ->where('parametros_id', $id_municipio)
            ->where('plataforma', $id_parroquia)
            ->select(
                DB::raw('sum(familias) as familias'),
                DB::raw('sum(tm) as tm'),
                DB::raw("DATE_FORMAT(fecha,'%m') as months")
            )
            ->groupBy('months')
            ->get();

        $total_familias = $parametros->sum('familias');
        $total_tm = $parametros->sum('tm');

        return view('android.tienda_enlinea.parroquia')
            ->with('municipio', $municipio)
            ->with('plataforma', $id_parroquia)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ->with('ferias', $ferias)
            ->with('i', 0);
    }
}
