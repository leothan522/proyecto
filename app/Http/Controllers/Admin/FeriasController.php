<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Http\Request;

class FeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::all();

        //JSON Parroquias
        $i = 0;
        $json_parroquias_valor[] = null;
        $json_parroquias_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $items = Parroquia::where('municipios_id', $municipio->id)->get();
            foreach ($items as $item) {
                array_push($array_valor, $item->nombre_completo);
                array_push($array_id, $item->id);
            }
            $json_parroquias_valor[$i] = $array_valor;
            $json_parroquias_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }
        return view('admin.ferias.index');
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
