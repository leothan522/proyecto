<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Clap;
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
        $claps = Clap::where('cedula_lider', 'LIKE', '%'.$request->buscar.'%')->get();
        return view('android.buscar_clap.buscar_cedula')
            ->with('resultados', $claps)
            ->with('buscar', $request->buscar)
            ->with('i', 0);
    }


}
