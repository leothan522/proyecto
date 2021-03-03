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

        return view('android.modulo_clap.index')
            ->with('estadal', $estadal)
            ->with('claps', $claps_estadal)
            ->with('municipios', $municipios);
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
            /*$familias = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $parroquia->id)->first();
            if ($familias) {
                $parroquia->familias = $familias->valor;
            } else {
                $parroquia->familias = 0;
            }*/

        });
        $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $id_municipio)->first();
        $claps = Parametro::where('nombre', 'claps')->where('tabla_id', $id_municipio)->first();
        $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $id_municipio)->orderBy('valor', 'ASC')->get();
        $bloques->each(function ($bloque) {
            $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $bloque->id)->first();
            if ($clap) {
                $bloque->claps = $clap->valor;
            } else {
                $bloque->claps = 0;
            }
            $familias = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
            if ($familias) {
                $bloque->familias = $familias->valor;
            } else {
                $bloque->familias = 0;
            }

        });


        return view('android.modulo_clap.municipio')
            ->with('familias', $familias)
            ->with('claps', $claps)
            ->with('municipio', $municipio)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques);
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



        return view('android.modulo_clap.parroquia')
            ->with('municipio', $municipio)
            ->with('parroquia', $parroquia)
            ->with('claps', $claps)
            ->with('i', 0);
    }

    public function verBloque($id, $id_municipio, $id_bloque)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);
        $bloque = Parametro::find($id_bloque);
        $claps = Clap::where('bloques_id', $id_bloque)->orderBy('nombre_clap', 'ASC')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }

        });

        return view('android.modulo_clap.bloque')
            ->with('municipio', $municipio)
            ->with('bloque', $bloque)
            ->with('claps', $claps)
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



        return view('android.modulo_clap.buscar_bloque')
            ->with('municipio', $municipio)
            ->with('bloque', $bloque)
            ->with('claps', $claps)
            ->with('buscar', $request->buscar)
            ->with('i', 0);
    }

}
