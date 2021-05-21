<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Clap;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use App\Models\Periodo;
use Illuminate\Http\Request;

class ModuloClapController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $estadal = Parametro::where('nombre', 'familias_estadal')->first();
        $claps_estadal = Parametro::where('nombre', 'claps_estadal')->first();
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->get();
        $municipios->each(function ($municipio) {
            $clap = Parametro::where('nombre', 'claps')->where('tabla_id', $municipio->id)->first();
            if ($clap) {
                $municipio->claps = $clap->valor;
            } else {
                $municipio->claps = 0;
            }
            $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $municipio->id)->first();
            if ($familias) {
                $municipio->familias = $familias->valor;
            } else {
                $municipio->familias = 0;
            }

        });

        $programa_clap = Clap::where('programa', 'CLAP')->count();
        $programa_bms = Clap::where('programa','!=', 'CLAP')->count();

        return view('android.modulo_clap.index')
            ->with('estadal', $estadal)
            ->with('claps', $claps_estadal)
            ->with('municipios', $municipios)
            ->with('programa_clap', $programa_clap)
            ->with('programa_bms', $programa_bms);
    }

    public function verMunicipio($id, $id_municipio)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);

        $parroquias = Parroquia::where('municipios_id', $id_municipio)->orderBy('nombre_completo', 'ASC')->get();
        $parroquias->each(function ($parroquia) {
            $clap = Clap::where('parroquias_id', $parroquia->id)->count();
            if ($clap) {
                $parroquia->claps = $clap;
            } else {
                $parroquia->claps = 0;
            }
            $familias = Clap::where('parroquias_id', $parroquia->id)->sum('num_familias');
            $parroquia->familias = $familias;

        });

        $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $id_municipio)->first();
        $claps = Parametro::where('nombre', 'claps')->where('tabla_id', $id_municipio)->first();

        $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $id_municipio)->orderBy('valor', 'ASC')->get();
        $bloques->each(function ($bloque) {

            $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $bloque->id)->first();
            if ($clap) { $bloque->claps = $clap->valor; } else { $bloque->claps = 0; }

            $familias = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
            if ($familias) { $bloque->familias = $familias->valor; } else { $bloque->familias = 0; }

            $periodos = Periodo::where('parametros_id', $bloque->id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($periodos){ $bloque->periodo = $periodos->fecha_atencion; }else{ $bloque->periodo = null; }

        });

        $periodos = Periodo::where('municipios_id', $id_municipio)->where('tipo_entrega', 'completa')->orderBy('fecha_atencion', 'DESC')->get();
        $dias = 0;
        $bloque = null;
        foreach ($periodos as $periodo){
            if ($bloque == $periodo->parametros_id){
                continue;
            }else{
                $bloque = $periodo->parametros_id;
            }
            $dias = $dias + cuantosDias($periodo->fecha_atencion, date('Y-m-d'));
        }
        $periodo_atencion = formatoMillares($dias / $bloques->count(), 0);

        $ferias = Periodo::where('municipios_id', $id_municipio)->orderBy('fecha_atencion', 'DESC')->get();

        return view('android.modulo_clap.municipio')
            ->with('familias', $familias)
            ->with('claps', $claps)
            ->with('municipio', $municipio)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques)
            ->with('periodo_atencion', $periodo_atencion)
            ->with('ferias', $ferias)
            ->with('i', 0);
    }

    public function verParroquia($id, $id_municipio, $id_parroquia)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);
        $parroquia = Parroquia::find($id_parroquia);
        $claps = Clap::where('parroquias_id', $id_parroquia)->orderBy('nombre_clap', 'ASC')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }
        });

        $familias = Clap::where('parroquias_id', $parroquia->id)->sum('num_familias');

        return view('android.modulo_clap.parroquia')
            ->with('municipio', $municipio)
            ->with('parroquia', $parroquia)
            ->with('claps', $claps)
            ->with('familias', $familias)
            ->with('i', 0);
    }

    public function verBloque($id, $id_municipio, $id_bloque)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);
        $bloque = Parametro::find($id_bloque);
        $periodo = Periodo::where('parametros_id', $id_bloque)->orderBy('fecha_atencion', 'DESC')->first();
        if ($periodo){ $periodo_atencion = $periodo->fecha_atencion; }else{ $periodo_atencion = null; }

        $claps = Clap::where('bloques_id', $id_bloque)->orderBy('nombre_clap', 'ASC')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }

        });

        $familias = Clap::where('bloques_id', $bloque->id)->sum('num_familias');
        if (!$familias){
            $parametro = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
            $familias = $parametro->valor;
        }

        return view('android.modulo_clap.bloque')
            ->with('municipio', $municipio)
            ->with('bloque', $bloque)
            ->with('claps', $claps)
            ->with('familias', $familias)
            ->with('periodo_atencion', $periodo_atencion)
            ->with('i', 0);
    }


    public function buscarEnParroquia(Request $request, $id)
    {
        //dd($request->all());
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($request->id_municipio);
        $parroquia = Parroquia::find($request->id_parroquia);
        $claps = Clap::where('parroquias_id', $request->id_parroquia)->where('nombre_clap', 'LIKE', '%'.$request->buscar.'%')->orderBy('nombre_clap', 'ASC')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }

        });

        return view('android.modulo_clap.buscar')
            ->with('municipio', $municipio)
            ->with('parroquia', $parroquia)
            ->with('claps', $claps)
            ->with('buscar', $request->buscar)
            ->with('i', 0);
    }


    public function buscarEnBloque(Request $request, $id)
    {
        //dd($request->all());
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($request->id_municipio);
        $bloque = Parametro::find($request->id_bloque);
        $claps = Clap::where('bloques_id', $request->id_bloque)->where('nombre_clap', 'LIKE', '%'.$request->buscar.'%')->orderBy('nombre_clap', 'ASC')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }

        });

        return view('android.modulo_clap.buscar_bloque')
            ->with('municipio', $municipio)
            ->with('bloque', $bloque)
            ->with('claps', $claps)
            ->with('buscar', $request->buscar)
            ->with('i', 0);
    }

}
