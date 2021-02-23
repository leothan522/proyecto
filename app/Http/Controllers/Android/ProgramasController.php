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
    public function moduloClap($id)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $estadal = Parametro::where('nombre', 'familias_estadal')->first();
        $claps_estadal = Parametro::where('nombre', 'claps_estadal')->first();
        $municipios = Municipio::orderBy('nombre_completo', 'ASC')->get();
        $municipios->each(function ($municipio) {
            $clap = Parametro::where('nombre', 'claps')->where('tabla_id', $municipio->id)->first();
            if ($clap) {
                $municipio->claps = $clap->valor;
            } else {
                $municipio->claps = 0;
            }
            $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $municipio->id)->first();
            if ($familias) {
                $municipio->familias = $familias->valor;
            } else {
                $municipio->familias = 0;
            }

        });

        return view('android.modulo_clap.index')
            ->with('estadal', $estadal)
            ->with('claps', $claps_estadal)
            ->with('municipios', $municipios);
    }

    public function moduloClapParroquias($id, $id_municipio)
    {
        $autenticar = new AppController();
        $autenticar->autenticar($id);

        $municipio = Municipio::find($id_municipio);
        $parroquias = Parroquia::where('municipios_id', $id_municipio)->get();
        $parroquias->each(function ($parroquia) {
            $clap = Clap::where('parroquias_id', $parroquia->id)->count();
            if ($clap) {
                $parroquia->claps = $clap;
            } else {
                $parroquia->claps = 0;
            }
            /*$familias = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $parroquia->id)->first();
            if ($familias) {
                $parroquia->familias = $familias->valor;
            } else {
                $parroquia->familias = 0;
            }*/

        });
        $familias = Parametro::where('nombre', 'familias')->where('tabla_id', $id_municipio)->first();
        $claps = Parametro::where('nombre', 'claps')->where('tabla_id', $id_municipio)->first();
        $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $id_municipio)->get();
        $bloques->each(function ($bloque) {
            $clap = Parametro::where('nombre', 'bloque_claps')->where('tabla_id', $bloque->id)->first();
            if ($clap) {
                $bloque->claps = $clap->valor;
            } else {
                $bloque->claps = 0;
            }
            $familias = Parametro::where('nombre', 'bloque_familias')->where('tabla_id', $bloque->id)->first();
            if ($familias) {
                $bloque->familias = $familias->valor;
            } else {
                $bloque->familias = 0;
            }

        });


        return view('android.modulo_clap.parroquias')
            ->with('familias', $familias)
            ->with('claps', $claps)
            ->with('municipio', $municipio)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques);
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
