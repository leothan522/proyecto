<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Censo;
use App\Models\Clap;
use App\Models\Periodo;
use Illuminate\Http\Request;

class ModuloBuscarController extends Controller
{
    public function index($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.buscar_clap.index');
        //return view('android.prueba');
    }

    public function buscarCedula(Request $request)
    {

        //$buscar = str_replace(".", "", $request->buscar);
        $buscar = intval(preg_replace('/[^0-9]+/', '', $request->buscar), 10);

        $claps = Clap::where('cedula_lider', 'LIKE', '%'.$buscar.'%')->get();
        $claps->each(function ($clap){
            $perido = Periodo::where('parametros_id', $clap->bloques_id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }else{
                $clap->periodo = null;
            }

        });

        $censo = Censo::where('cedula', 'LIKE', '%'.$buscar.'%')->get();
        $censo->each(function ($clap){

            $clap->periodo = null;
            $clap->jefe_familia = null;

            $perido = Periodo::where('parametros_id', $clap->claps->parametros->id)->orderBy('fecha_atencion', 'DESC')->first();
            if ($perido){
                $clap->periodo = $perido->fecha_atencion;
            }

            if ($clap->miembro_familia != "Jefe de Familia"){
                $familia = Censo::where('num_familia', $clap->num_familia)->where('miembro_familia', 'Jefe de Familia')->first();
                if ($familia){
                    $clap->jefe_familia = $familia->nombre_completo." <small><small>(CI: ".formatoMillares($familia->cedula, 0).")</small></small>";
                }
            }

            $clap->miembros = Censo::where('num_familia', $clap->num_familia)->count();

        });
        return view('android.buscar_clap.buscar_cedula')
            ->with('resultados', $claps)
            ->with('censo', $censo)
            ->with('buscar', $buscar)
            ->with('i', 0);
    }


}
