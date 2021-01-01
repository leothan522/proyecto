<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParroquiasRequest;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ParroquiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parroquias = Parroquia::orderBy('municipios_id', 'ASC')->paginate(45);
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->pluck('nombre_completo', 'id');
        $i = 1;
        return view('admin.parroquias.index')
            ->with('parroquias', $parroquias)
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
    public function store(ParroquiasRequest $request)
    {
        $parroquia = new Parroquia($request->all());
        $parroquia->save();
        //flash('Parroquia Creado Correctamente', 'success')->important();
        verSweetAlert2('Parroquia creada correctamente.');
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
        $parroquia = Parroquia::find($id);
        $municipio = $parroquia->municipios_id;
        $nombre = $parroquia->nombre_completo;
        $abreviado = $parroquia->nombre_corto;
        if ($municipio == $request->municipios_id2 && $nombre == $request->nombre_completo2 && $abreviado == $request->nombre_corto2){
            //flash('No se realizo ningun cambio', 'warning')->important();
            verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
            return back();
        }else{
            $rules = [
                'nombre_completo' => ['required', 'min:4', Rule::unique('parroquias')->ignore($id),],
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
            $parroquia->municipios_id = $request->municipios_id2;
            $parroquia->nombre_completo = $request->nombre_completo2;
            $parroquia->nombre_corto = $request->nombre_corto2;
            $parroquia->update();
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
        $parroqua = Parroquia::find($id);
        $nombre = strtoupper($parroqua->nombre_completo);
        $parroqua->delete();
        //flash('Eliminado Exitosamente', 'danger')->important();
        verSweetAlert2("Borrada la parroquia <strong class='text-danger'>$nombre</strong>", 'iconHtml', 'error');
        return back();
    }
}
