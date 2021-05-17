<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fisica;
use App\Models\Movil;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;

class TiendaFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $ferias = Fisica::where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);

        $tiendas = Parametro::where('nombre', 'tienda_fisica')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });


        return view('admin.tienda_fisica.index')
            ->with('municipios', $select_municipios)
            ->with('ferias', $ferias)
            ->with('tiendas', $tiendas)
            ->with('select_tiendas', $tiendas->pluck('municipio', 'id'))
            ->with('i', 1);
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

        if ($request->nombre) {

            if ($request->valor == null) {
                $municipio = Municipio::find($request->tabla_id);
                $valor = trim($municipio->nombre_corto);
            } else {
                $valor = $request->valor;
            }

            $parametro = new Parametro($request->all());
            $parametro->valor = strtoupper($valor);
            $parametro->save();
            verSweetAlert2('Tienda Fisica agreagada correctamente');
        } else {

            $existe = Fisica::where('parametros_id', $request->parametros_id)->where('band', 1)->first();
            if ($existe){
                if ($existe->fecha < $request->fecha){
                    $viejos = Fisica::where('parametros_id', $request->parametros_id)->get();
                    foreach ($viejos as $viejo) {
                        $viejo->band = 0;
                        $viejo->update();
                    }
                    $band = 1;
                }else{
                    $band = 0;
                }

            }else{
                $band = 1;
            }

            $fisica = new Fisica($request->all());
            $fisica->band = $band;
            $fisica->save();
            verSweetAlert2('Reporte cargado correctamente');
        }
        //verSweetAlert2('Feria Campo Soberano cargada correctamente');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $ferias = Fisica::where('parametros_id', $id)->where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);

        $tiendas = Parametro::where('nombre', 'tienda_fisica')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });


        return view('admin.tienda_fisica.index')
            ->with('municipios', $select_municipios)
            ->with('ferias', $ferias)
            ->with('tiendas', $tiendas)
            ->with('select_tiendas', $tiendas->pluck('municipio', 'id'))
            ->with('i', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $ferias = Fisica::where('parametros_id', $id)->orderBy('fecha', 'DESC')->paginate(30);

        $tiendas = Parametro::where('nombre', 'tienda_fisica')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });


        return view('admin.tienda_fisica.show')
            ->with('municipios', $select_municipios)
            ->with('ferias', $ferias)
            ->with('tiendas', $tiendas)
            ->with('select_tiendas', $tiendas->pluck('municipio', 'id'))
            ->with('i', 1);
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


        if ($request->nombre) {

            if ($request->valor == null) {
                $municipio = Municipio::find($request->tabla_id);
                $valor = trim($municipio->nombre_corto);
            } else {
                $valor = $request->valor;
            }

            $parametro = Parametro::find($id);
            $parametro->fill($request->all());
            $parametro->valor = strtoupper($valor);
            $parametro->update();
            verSweetAlert2('Tienda Fisica modificada correctamente');
        } else {
            $feria = Fisica::find($id);
            $feria->familias = $request->familias;
            $feria->tm = $request->tm;
            $feria->fecha = $request->fecha;
            $feria->update();
            verSweetAlert2('Reporte Actualizado', 'toast');
        }

        //verSweetAlert2('Feria Campo Soberano Actualizada', 'toast');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feria = Fisica::find($id);
        $existe = Fisica::where('id', '!=', $id)->where('parametros_id', $feria->parametros_id)->where('band', 1)->orderBy('fecha', 'DESC')->first();
        if (!$existe){
            $viejo = Fisica::where('id', '!=', $id)->where('parametros_id', $feria->parametros_id)->where('band', 0)->orderBy('fecha', 'DESC')->first();
            if ($viejo){
                $viejo->band = 1;
                $viejo->update();
            }
        }

        $feria->delete();

        verSweetAlert2("Reporte Borrado Correctamente",'toast');
        return back();
    }

    public function destroyParametro($id)
    {
        $parametro = Parametro::find($id);
        $parametro->delete();
        verSweetAlert2("Tienda Fisica Borrada Correctamente", 'toast');
        return back();
    }

}
