<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MunicipiosRequest;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class MunicipiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->paginate(20);
        $i = 1;
        return view('admin.municipios.index')
            ->with('municipios', $municipios)
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
    public function store(MunicipiosRequest $request)
    {
        $municipio = new Municipio($request->all());
        $municipio->save();
        //flash('Municipio Creado Correctamente', 'success')->important();
        verSweetAlert2('Municipio creado correctamente.');
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
        $municipio = Municipio::find($id);
        $nombre = $municipio->nombre_completo;
        $abreviado = $municipio->nombre_corto;
        if ($nombre == $request->nombre_completo2 && $abreviado == $request->nombre_corto2){
            //flash('No se realizo ningun cambio', 'warning')->important();
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
            return back();
        }else{
            $rules = [
                'nombre_completo' => ['required', 'min:8', Rule::unique('municipios')->ignore($id),],
                'nombre_corto' => 'required|min:4'
            ];
            $data = [
                'nombre_completo' => $request->nombre_completo2,
                'nombre_corto' => $request->nombre_corto2
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()){
                //flash('Parametro Repetido. No se pudo guardar', 'warning')->important();
                verSweetAlert2('Parametro Repetido. No se pudo guardar.', 'toast', 'error');
                return back();
            }
            $municipio->nombre_completo = $request->nombre_completo2;
            $municipio->nombre_corto = $request->nombre_corto2;
            $municipio->update();
            //flash('Modificado Exitosamente', 'primary')->important();
            verSweetAlert2('Cambios guardados correctamente.');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $municipio = Municipio::find($id);
        $nombre = strtoupper($municipio->nombre_completo);
        $municipio->delete();
        //flash('Eliminado Exitosamente', 'danger')->important();
        verSweetAlert2("Borrada el municipio <strong class='text-danger'>$nombre</strong>", 'iconHtml', 'error');
        return back();
    }
}
