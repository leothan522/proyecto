<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enlinea;
use App\Models\Ferias;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use App\Models\Proteico;
use Illuminate\Http\Request;

class PlanProteicoController extends Controller
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


        $ferias = Proteico::where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);
        $filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();

        $tiendas = Parametro::where('nombre', 'tienda_enlinea')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });

        $procedencias = Parametro::where('nombre', 'proteico_procedencia')->orderBy('id', 'ASC')->get();
        $rubros = Parametro::where('nombre', 'proteico_rubro')->orderBy('id', 'ASC')->get();


        return view('admin.plan_proteico.index')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
            ->with('filtrar', $filtrar)
            ->with('tiendas', $tiendas)
            ->with('procedencias', $procedencias)
            ->with('select_procedencias', $procedencias->pluck('valor', 'id'))
            ->with('rubros', $rubros)
            ->with('i', 0);
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

        if ($request->nombre) {
            $parametro = new Parametro($request->all());
            $parametro->valor = strtoupper($request->valor);
            $parametro->save();
            verSweetAlert2('Parametro agreagado correctamente');

        } else {
            $rubros = [];
            $cont = $request->cont;

            if ($cont == 0){
                verSweetAlert2("Se debe Elegir algun Rubro", 'toast');
                return back();
            }else{
                for ($i = 1; $i <= $cont; $i++){
                    if ($request->input('rubro'.$i)){
                        $rubros[$request->input('rubro'.$i)] = true;
                    }
                }
                if (empty($rubros)){
                    verSweetAlert2("Se debe Elegir algun Rubro", 'toast');
                    return back();
                }
            }

            $existe = Proteico::where('parroquias_id', $request->parroquias_id)->where('band', 1)->first();
            if ($existe) {
                if ($existe->fecha < $request->fecha) {
                    $viejos = Proteico::where('parroquias_id', $request->parroquias_id)->where('parametros_id', $request->parametros_id)->get();
                    foreach ($viejos as $viejo) {
                        $viejo->band = 0;
                        $viejo->update();
                    }
                    $band = 1;
                } else {
                    $band = 0;
                }

            } else {
                $band = 1;
            }


            $fisica = new Proteico($request->all());
            $fisica->band = $band;
            $fisica->rubros = json_encode($rubros);
            $fisica->save();
            verSweetAlert2('Reporte cargado correctamente');

        }

        //verSweetAlert2('Feria Campo Soberano cargada correctamente');
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


        $ferias = Proteico::where('municipios_id', $id)->where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);
        $filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();

        $tiendas = Parametro::where('nombre', 'tienda_enlinea')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });

        $procedencias = Parametro::where('nombre', 'proteico_procedencia')->orderBy('id', 'ASC')->get();
        $rubros = Parametro::where('nombre', 'proteico_rubro')->orderBy('id', 'ASC')->get();


        return view('admin.plan_proteico.index')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
            ->with('filtrar', $filtrar)
            ->with('tiendas', $tiendas)
            ->with('procedencias', $procedencias)
            ->with('select_procedencias', $procedencias->pluck('valor', 'id'))
            ->with('rubros', $rubros)
            ->with('i', 0);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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


        $ferias = Proteico::where('parroquias_id', $id)->orderBy('fecha', 'DESC')->paginate(30);
        $filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();

        $tiendas = Parametro::where('nombre', 'tienda_enlinea')->orderBy('nombre', 'ASC')->get();
        $tiendas->each(function ($tienda) {
            $municipio = Municipio::find($tienda->tabla_id);
            if (trim($municipio->nombre_corto) == $tienda->valor) {
                $tienda->valor_opcional = null;
            } else {
                $tienda->valor_opcional = $tienda->valor;
            }
            $tienda->municipio = $municipio->nombre_corto;
        });

        $procedencias = Parametro::where('nombre', 'proteico_procedencia')->orderBy('id', 'ASC')->get();
        $rubros = Parametro::where('nombre', 'proteico_rubro')->orderBy('id', 'ASC')->get();


        return view('admin.plan_proteico.show')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
            ->with('filtrar', $filtrar)
            ->with('tiendas', $tiendas)
            ->with('procedencias', $procedencias)
            ->with('select_procedencias', $procedencias->pluck('valor', 'id'))
            ->with('rubros', $rubros)
            ->with('i', 0);
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
        if ($request->nombre) {
            $parametro = Parametro::find($id);
            $parametro->fill($request->all());
            $parametro->valor = strtoupper($request->valor);
            $parametro->update();
            verSweetAlert2('Parametro modificado correctamente');
        } else {

            $rubros = [];
            $cont = $request->cont;

            if ($cont == 0){
                verSweetAlert2("Se debe Elegir algun Rubro", 'toast');
                return back();
            }else{
                for ($i = 1; $i <= $cont; $i++){
                    if ($request->input('rubro'.$i)){
                        $rubros[$request->input('rubro'.$i)] = true;
                    }
                }
                if (empty($rubros)){
                    verSweetAlert2("Se debe Elegir algun Rubro", 'toast');
                    return back();
                }
            }

            $feria = Proteico::find($id);
            $feria->parametros_id = $request->parametros_id;
            $feria->rubros = json_encode($rubros);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feria = Proteico::find($id);
        $viejo = Proteico::where('id', '!=', $id)->where('parroquias_id', $feria->parroquias_id)->where('band', 0)->orderBy('fecha', 'DESC')->first();
        if ($viejo){
            $viejo->band = 1;
            $viejo->update();
        }
        $feria->delete();
        verSweetAlert2("Reporte Borrado Correctamente",'toast');
        return back();
    }

    public function destroyParametro($id)
    {
        $parametro = Parametro::find($id);
        $parametro->delete();
        verSweetAlert2("Parametro Borrado Correctamente", 'toast');
        return back();
    }
}
