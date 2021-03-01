<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $mun_bloques = [];
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::all();
        $periodos = Periodo::orderBy('fecha_atencion', 'ASC')->paginate(30);
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


        return view('admin.periodos.index')
            ->with('municipios', $select_municipios)
            ->with('json_bloque_valor', $json_bloque_valor)
            ->with('json_bloque_id', $json_bloque_id)
            ->with('mun_bloques', $mun_bloques)
            ->with('periodos', $periodos)
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
