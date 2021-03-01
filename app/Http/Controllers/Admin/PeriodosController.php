<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Parametro;
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
        $bloques = [];
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->get();

        //JSON Bloques
        $i = 0;
        $json_bloques_valor[] = null;
        $json_bloques_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $items = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->get();
            foreach ($items as $item) {
                array_push($array_valor, $item->valor);
                array_push($array_id, $item->id);
            }
            $json_bloques_valor[$i] = $array_valor;
            $json_bloques_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }
        return view('admin.periodos.index')
            ->with('municipios', $municipios->pluck('nombre_completo', 'id'))
            ->with('json_bloques_valor', $json_bloques_valor)
            ->with('json_bloques_id', $json_bloques_id)
            ->with('bloques', $bloques);
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
        //
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
