<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamiliasRequest;
use App\Models\Municipio;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Validator;

class FamiliasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->pluck('nombre_completo', 'id');
        $estadal = Parametro::where('nombre', 'familias_estadal')->first();
        $claps_estadal = Parametro::where('nombre', 'claps_estadal')->first();
        $parametros = Parametro::where('nombre', 'familias')->paginate(30);
        $parametros->each(function ($familia){
            $clap = Parametro::where('nombre', 'claps')->where('tabla_id', $familia->tabla_id)->first();
            $familia->claps = $clap->valor;
            $familia->id_clap = $clap->id;
        });
        $i = 1;
        return view('admin.familias.index')
            ->with('municipios', $municipios)
            ->with('estadal', $estadal)
            ->with('claps', $claps_estadal)
            ->with('familias', $parametros)
            ->with('i', $i);
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
    public function store(FamiliasRequest $request)
    {
        $parametros = Parametro::where('nombre', 'familias')->where('tabla_id', $request->tabla_id)->first();
        if ($parametros){
            flash('Parametro Repetido. No se pudo guardar', 'warning')->important();
            return back()->withInput();
        }
        $familias = new Parametro($request->all());
        $familias->save();
        $claps = new Parametro($request->all());
        $claps->nombre = $request->nombre_clap;
        $claps->valor = $request->valor_clap;
        $claps->save();
        flash('Parametro Guardado Exitosamente', 'success')->important();
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
        $familias = Parametro::find($id);
        $claps = Parametro::find($request->id_clap);
        $valor_clap = $claps->valor;
        $mun = $familias->tabla_id;
        $valor = $familias->valor;
        if($mun == $request->tabla_id2 && $valor == $request->valor2 && $valor_clap == $request->valor_clap2){
            flash('No se realizo ningun cambio', 'warning')->important();
            return back();
        }
        $parametros = Parametro::where('nombre', 'familias')->where('tabla_id', $request->tabla_id2)->first();
        if ($parametros && $parametros->id != $id){
            flash('Parametro Repetido. No se pudo guardar', 'warning')->important();
            return back();
        }
        $familias->tabla_id = $request->tabla_id2;
        $familias->valor = $request->valor2;
        $familias->update();
        $claps->tabla_id = $request->tabla_id2;
        $claps->valor = $request->valor_clap2;
        $claps->update();
        flash('Parametro Modificado Exitosamente', 'primary')->important();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, $id)
    {
        $familias = Parametro::find($id);
        $familias->delete();
        $claps = Parametro::find($request->id_clap);
        $claps->delete();
        flash('Parametro Eliminado Exitosamente', 'danger')->important();
        return back();
    }
}
