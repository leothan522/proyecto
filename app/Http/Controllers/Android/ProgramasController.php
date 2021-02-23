<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Models\Parametro;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{
    public function moduloClap($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $estadal = Parametro::where('nombre', 'familias_estadal')->first();
        $claps_estadal = Parametro::where('nombre', 'claps_estadal')->first();
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->get();
        $municipios->each(function ($municipio){
            $clap = Parametro::where('nombre', 'claps')->where('tabla_id', $municipio->id)->first();
            if ($clap){
                $municipio->claps = $clap->valor;
            }else{
                $municipio->claps = 0;
            }
            $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $municipio->id)->first();
            if ($familias){
                $municipio->familias = $familias->valor;
            }else{
                $municipio->familias = 0;
            }

        });

        return view('android.modulo_clap.index')
            ->with('estadal', $estadal)
            ->with('claps', $claps_estadal)
            ->with('municipios', $municipios)
            ;
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
