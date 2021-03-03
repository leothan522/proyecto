<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Clap;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{

    public function feriasCampo($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        //return view('android.ferias_campo.index');
        return view('android.prueba');
    }

    public function planProteico($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        //return view('android.plan_proteico.index');
        return view('android.prueba');
    }

    public function tiendaFisica($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        //return view('android.tienda_fisica.index');
        return view('android.prueba');
    }

    public function tiendaEnlinea($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        //return view('android.tienda_enlinea.index');
        return view('android.prueba');
    }

    public function tiendaMovil($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        //return view('android.tienda_movil.index');
        return view('android.prueba');
    }

    /*public function buscarClap($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.buscar_clap.index');
        //return view('android.prueba');
    }*/

}
