<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Parametro;
use Illuminate\Http\Request;

class BloquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->paginate(20);
        $municipios->each(function ($municipio) {
            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->count();
            $municipio->bloques = $bloques;
        });
        $total = Parametro::where('nombre', 'bloques')->count();
        $i = 1;
        return view('admin.bloques.index')
            ->with('municipios', $municipios)
            ->with('total', $total)
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bloques = new Parametro($request->all());
        $bloques->save();
        flash('Bloque Creado en ' . $bloques->municipios->nombre_corto, 'success')->important();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //dd($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensaje_nombre = true;
        $mensaje_clap = true;
        $mensaje_familias = true;

        $bloque = Parametro::find($id);
        $nombre = $bloque->valor;
        if ($nombre != $request->nombre_bloque){
            $bloque->valor = $request->nombre_bloque;
            $bloque->update();
        }else{
            $mensaje_nombre = false;
        }


        if ($request->id_clap == null){
            $clap = new Parametro();
            $clap->nombre = $request->nombre_clap;
            $clap->tabla_id = $id;
            $clap->valor = $request->valor_clap;
            $clap->save();
        }else{
            $clap = Parametro::find($request->id_clap);
            $valor = $clap->valor;
            if($valor != $request->valor_clap){
                $clap->valor = $request->valor_clap;
                $clap->update();
            }else{
                $mensaje_clap = false;
            }

        }

        if ($request->id_familias == null){
            $familia = new Parametro();
            $familia->nombre = $request->nombre_familias;
            $familia->tabla_id = $id;
            $familia->valor = $request->valor_familias;
            $familia->save();
        }else{
            $familia = Parametro::find($request->id_familias);
            $valor = $familia->valor;
            if ($valor != $request->valor_familias){
                $familia->valor = $request->valor_familias;
                $familia->update();
            }else{
                $mensaje_familias = false;
            }

        }

        if($mensaje_nombre || $mensaje_clap || $mensaje_familias){
            flash('Bloque Modificado Exitosamente', 'primary')->important();
        }else{
            flash('Nose realizo ningun cambio', 'warning')->important();
        }

        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->consultar){

            $bloque = Parametro::find($id);
            $municipio = Municipio::find($bloque->tabla_id);

            $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $id)->first();
            if ($clap){
                $clap->delete();
            }

            $familia = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $id)->first();
            if ($familia){
                $familia->delete();
            }

            $bloque->delete();

        }else{

            $municipio = Municipio::find($id);
            $parametros = Parametro::where('nombre', 'bloques')->where('tabla_id', $id)->orderBy('id', 'DESC')->first();
            $parametros->delete();

        }

        flash('Bloque Eliminado en ' . $municipio->nombre_corto, 'danger')->important();
        return back();
    }

    public function consultar(Request $request)
    {
        $total_claps = null;
        $total_familias = null;
        $mun_claps = null;
        $mun_familias = null;

        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $municipios = Municipio::all();
        $total = Parametro::where('nombre', 'bloques')->count();


        $i = 0;
        $json_bloque_valor[] = null;
        $json_bloque_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->get();
            foreach ($bloques as $bloque) {
                array_push($array_valor, $bloque->valor);
                array_push($array_id, $bloque->id);
            }
            $json_bloque_valor[$i] = $array_valor;
            $json_bloque_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }

        if ($request->all()){

            $ver_municipios = Municipio::find($request->municipios_id);
            $ver_bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $request->municipios_id)->where('id','LIKE', $request->bloques_id)->get();
            $ver_bloques->each(function ($bloque){
                $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $bloque->id)->first();
                if ($clap){
                    $bloque->claps = $clap->valor;
                    $bloque->id_clap = $clap->id;
                }else{
                    $bloque->claps = null;
                    $bloque->id_clap = null;
                }
                $familia = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
                if ($familia){
                    $bloque->familias = $familia->valor;
                    $bloque->id_familia = $familia->id;
                }else{
                    $bloque->familias = null;
                    $bloque->id_familia = null;
                }

            });


            $mun_claps = Parametro::where('nombre', 'claps')->where('tabla_id', $request->municipios_id)->sum('valor');
            $mun_familias = Parametro::where('nombre', 'familias')->where('tabla_id', $request->municipios_id)->sum('valor');

            foreach ($ver_bloques as $bloque){
                $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $bloque->id)->first();
                if ($clap){
                    $total_claps = $total_claps + $clap->valor;
                }
                $familia = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
                if ($familia){
                    $total_familias = $total_familias + $familia->valor;
                }
            }

            $total = $ver_bloques->count();

        }else{
            $ver_bloques = null;
            $ver_municipios = null;
        }


        return view('admin.bloques.consultar')
            ->with('municipios', $select_municipios)
            ->with('json_bloque_valor', $json_bloque_valor)
            ->with('json_bloque_id', $json_bloque_id)
            ->with('ver_bloques', $ver_bloques)
            ->with('ver_municipio', $ver_municipios)
            ->with('total_claps', $total_claps)
            ->with('total_familias', $total_familias)
            ->with('mun_claps', $mun_claps)
            ->with('mun_familias', $mun_familias)
            ->with('total', $total);
    }

}
