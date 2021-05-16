<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Ferias;
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


		$ferias = Ferias::where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);
		$filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();


        return view('admin.ferias.index')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
			->with('filtrar', $filtrar)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = Ferias::where('parroquias_id', $request->parroquias_id)->where('band', 1)->first();
        if ($existe){
            if ($existe->fecha < $request->fecha){
                $viejos = Ferias::where('parroquias_id', $request->parroquias_id)->get();
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
		/*$viejos = Ferias::where('parroquias_id', $request->parroquias_id)->get();
        if ($viejos) {
            foreach ($viejos as $viejo) {
                $viejo->band = 0;
                $viejo->update();
            }
        }*/

        $feria = new Ferias($request->all());
        $feria->band = $band;
		$feria->save();
        verSweetAlert2('Feria Campo Soberano cargada correctamente');
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


		$ferias = Ferias::where('municipios_id', $id)->where('band', 1)->orderBy('fecha', 'DESC')->paginate(30);
		$filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();


        return view('admin.ferias.index')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
			->with('filtrar', $filtrar)
            ->with('i', 1);
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


		$ferias = Ferias::where('parroquias_id', $id)->orderBy('fecha', 'DESC')->paginate(30);
		$filtrar = Municipio::orderBy('nombre_completo', 'ASC')->get();


        return view('admin.ferias.show')
            ->with('municipios', $select_municipios)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('ferias', $ferias)
			->with('filtrar', $filtrar)
            ->with('i', 1);
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
        $feria = Ferias::find($id);
		$feria->familias = $request->familias;
		$feria->tm = $request->tm;
        $feria->fecha = $request->fecha;
        $feria->update();
        verSweetAlert2('Feria Campo Soberano Actualizada', 'toast');
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
        $feria = Ferias::find($id);
        $viejo = Ferias::where('id', '!=', $id)->where('parroquias_id', $feria->parroquias_id)->where('band', 0)->orderBy('fecha', 'DESC')->first();
        if ($viejo){
            $viejo->band = 1;
            $viejo->update();
        }
        $feria->delete();
        verSweetAlert2("Feria Campo Soberano Borrada Correctamente",'toast');
        return back();
    }
}
