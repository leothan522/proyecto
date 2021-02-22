<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{
    public function moduloClap($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.modulo_clap.index');
    }

    public function feriasCampo($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.ferias_campo.index');
    }

    public function planProteico($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.plan_proteico.index');
    }

    public function tiendaFisica($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.tienda_fisica.index');
    }

    public function tiendaEnlinea($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.tienda_enlinea.index');
    }

    public function buscarClap($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);
        return view('android.buscar_clap.index');
    }

}
