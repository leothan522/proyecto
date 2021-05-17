<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Fisica;
use App\Models\Movil;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiendaFisicaController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipios = Parametro::where('nombre', 'tienda_fisica')->orderBy('valor', 'ASC')->get();
        $municipios->each(function ($municipio) {
            $ferias = Fisica::where('fecha', 'LIKE', "%".date('Y')."%")->where('parametros_id', $municipio->id)->get();
            //$municipio->ferias = $ferias->count();
            $municipio->familias = $ferias->sum('familias');
            $municipio->tm = $ferias->sum('tm');
        });

        $ferias = Fisica::where('fecha', 'LIKE', "%".date('Y')."%")->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');

        return view('android.tienda_fisica.index')
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
            $ferias = Movil::where('fecha', 'LIKE', "%".date('Y')."%")->where('parroquias_id', $parroquia->id)->get();
            $parroquia->ferias = $ferias->count();
            $parroquia->familias = $ferias->sum('familias');
            $parroquia->tm = $ferias->sum('tm');

        });

        $ferias = Movil::where('fecha', 'LIKE', "%".date('Y')."%")->where('municipios_id', $id_municipio)->get();
        $total_ferias = $ferias->count();
        $total_familias = $ferias->sum('familias');
        $total_tm = $ferias->sum('tm');


        return view('android.tienda_fisica.municipio')
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

        $municipio = Parametro::find($id_municipio);
        $parametros = Fisica::where('fecha', 'LIKE', "%".date('Y')."%")->where('parametros_id', $id_municipio)->get();
        $ferias = Fisica::where('fecha', 'LIKE', "%".date('Y')."%")
                        ->where('parametros_id', $id_municipio)
                        ->select(
                            DB::raw('sum(familias) as familias'),
                            DB::raw('sum(tm) as tm'),
                            DB::raw("DATE_FORMAT(fecha,'%m') as months")
                        )
            ->groupBy('months')
            ->get();

        $total_familias = $parametros->sum('familias');
        $total_tm = $parametros->sum('tm');

        return view('android.tienda_fisica.parroquia')
            ->with('municipio', $municipio)
            ->with('total_familias', $total_familias)
            ->with('total_tm', $total_tm)
            ->with('ferias', $ferias)
            ->with('i', 0);
    }
}
