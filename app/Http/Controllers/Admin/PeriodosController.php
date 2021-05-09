<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clap;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::where('tipo_entrega', 'completa')->orderBy('fecha_atencion', 'ASC')->paginate(30);
        $periodos->each(function ($periodo){
            $parametro = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $periodo->parametros_id)->first();
            if ($parametro){ $periodo->familias = $parametro->valor; }else{ $periodo->familias = null; }
        });

        $total_claps = null;
        $total_familias = null;
        $mun_claps = null;
        $mun_familias = null;
        $claps_cargados = null;

        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::all();
        $total = Parametro::where('nombre', 'bloques')->count();
        $filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();


        $i = 0;
        $json_bloque_valor[] = null;
        $json_bloque_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->orderBy('valor', 'ASC')->get();
            foreach ($bloques as $bloque) {
                array_push($array_valor, $bloque->valor);
                array_push($array_id, $bloque->id);
            }
            $json_bloque_valor[$i] = $array_valor;
            $json_bloque_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }

        $id_bloque = null;
        $mun_bloques = [];


        return view('admin.periodos.index')
            ->with('municipios', $select_municipios)
            ->with('json_bloque_valor', $json_bloque_valor)
            ->with('json_bloque_id', $json_bloque_id)
            ->with('mun_bloques', $mun_bloques)
            ->with('periodos', $periodos)
            ->with('filtrar', $filtrar)
            ->with('i', 1)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $viejos = Periodo::where('parametros_id', $request->bloques_id)->get();
        if ($viejos) {
            foreach ($viejos as $viejo) {
                $viejo->tipo_entrega = "viejo";
                $viejo->update();
            }
        }

        $periodo = new Periodo($request->all());
        $periodo->parametros_id = $request->bloques_id;
        $periodo->save();
        verSweetAlert2('Fecha de atencion cargada correctamente');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periodos = Periodo::where('municipios_id', $id)->where('tipo_entrega', 'completa')->orderBy('fecha_atencion', 'ASC')->paginate(30);
        $periodos->each(function ($periodo){
            $parametro = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $periodo->parametros_id)->first();
            if ($parametro){ $periodo->familias = $parametro->valor; }else{ $periodo->familias = null; }
        });

        $total_claps = null;
        $total_familias = null;
        $mun_claps = null;
        $mun_familias = null;
        $claps_cargados = null;

        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::all();
        $total = Parametro::where('nombre', 'bloques')->count();
        $filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();


        $i = 0;
        $json_bloque_valor[] = null;
        $json_bloque_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->orderBy('valor', 'ASC')->get();
            foreach ($bloques as $bloque) {
                array_push($array_valor, $bloque->valor);
                array_push($array_id, $bloque->id);
            }
            $json_bloque_valor[$i] = $array_valor;
            $json_bloque_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }

        $id_bloque = null;
        $mun_bloques = [];


        return view('admin.periodos.index')
            ->with('municipios', $select_municipios)
            ->with('json_bloque_valor', $json_bloque_valor)
            ->with('json_bloque_id', $json_bloque_id)
            ->with('mun_bloques', $mun_bloques)
            ->with('periodos', $periodos)
            ->with('filtrar', $filtrar)
            ->with('i', 1)
            ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mun_bloques = [];
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->get();

        $periodos = Periodo::where('parametros_id', $id)->orderBy('fecha_atencion', 'ASC')->paginate(30);
        $periodos->each(function ($periodo){
            $parametro = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $periodo->parametros_id)->first();
            if ($parametro){ $periodo->familias = $parametro->valor; }else{ $periodo->familias = null; }
        });

        $i = 0;
        $json_bloque_valor[] = null;
        $json_bloque_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->orderBy('valor', 'ASC')->get();
            foreach ($bloques as $bloque) {
                array_push($array_valor, $bloque->valor);
                array_push($array_id, $bloque->id);
            }
            $json_bloque_valor[$i] = $array_valor;
            $json_bloque_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }


        return view('admin.periodos.show')
            ->with('municipios', $select_municipios)
            ->with('json_bloque_valor', $json_bloque_valor)
            ->with('json_bloque_id', $json_bloque_id)
            ->with('mun_bloques', $mun_bloques)
            ->with('periodos', $periodos)
            ->with('filtrar', $municipios)
            ->with('i', 1)
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periodo = Periodo::find($id);
        $periodo->fecha_atencion = $request->fecha_atencion;
        $periodo->update();
        verSweetAlert2('Fecha Actualizada', 'toast');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = Periodo::find($id);
        $viejo = Periodo::where('id', '!=', $id)->where('municipios_id', $periodo->municipios_id)->where('parametros_id', $periodo->parametros_id)->orderBy('fecha_atencion', 'DESC')->first();
        if ($viejo){
            $viejo->tipo_entrega = 'completa';
            $viejo->update();
        }
        $periodo->delete();
        verSweetAlert2("Fecha Borrada Correctamente",'toast');
        return back();
    }
}
