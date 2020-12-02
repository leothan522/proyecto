<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ImportClapsExport;
use App\Http\Controllers\Controller;
use App\Imports\ClapsImport;
use App\Models\Clap;
use App\Models\ImportClap;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
//use mysql_xdevapi\Exception;

class ClapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_claps = Clap::count();
        $select_municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $parroquias = [];
        $bloques = [];

        return view('admin.claps.index')
            ->with('total_claps', $total_claps)
            ->with('municipios', $select_municipios)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subirArchivo($id_import = null)
    {
        $claps_procesados = null;
        $claps_cargados = null;
        $import_claps = null;
        $detalle_import = null;
        $parametros = Parametro::where('nombre', 'import_clap')->orderBy('created_at', "DESC")->get();
        $parametros->each(function ($parametro) {
            $import = ImportClap::where('import_id', $parametro->id)->first();
            if ($import) {
                $parametro->class = "text-danger";
            } else {
                $parametro->class = "text-muted";
            }
        });
        if ($id_import) {
            $detalle_import = Parametro::findOrFail($id_import);
            $claps_table = Clap::where('import_id', $id_import)->count();
            $import_claps = ImportClap::where('import_id', $id_import)->count();
            $claps_procesados = $claps_table + $import_claps;

            $claps_cargados = Clap::where('import_id', $id_import)->get()->groupBy('municipios_id');
            foreach ($claps_cargados as $key => $claps) {
                $municipio = Municipio::find($key);
                $claps->nombre = $municipio->nombre_completo;
                $claps->total = $claps->count();
            }
        }
        return view('admin.claps.importar')
            ->with('parametros', $parametros)
            ->with('id_import', $id_import)
            ->with('claps_procesados', $claps_procesados)
            ->with('claps_cargados', $claps_cargados)
            ->with('import_claps', $import_claps)
            ->with('detalle_import', $detalle_import);
    }

    public function import(Request $request)
    {
        $parametros = new Parametro();
        $parametros->nombre = "import_clap";
        $parametros->valor = Auth::user()->id;
        $parametros->save();

        Excel::import(new ClapsImport($parametros->id), $request->file('excel'));

        flash('Importado Exitosamente', 'success')->important();
        return redirect()->route('claps.get_import', $parametros->id);
    }

    public function getRevision($id)
    {
        $parametro = Parametro::find($id);
        $imports = ImportClap::where('import_id', $id)->paginate(30);
        $i = 1;
        $municipios = Municipio::orderBy('nombre_corto', 'ASC')->pluck('nombre_corto', 'id');
        $parroquias = Parroquia::orderBy('nombre_completo', 'ASC')->pluck('nombre_completo', 'id');
        return view('admin.claps.por_revision')
            ->with('parametro', $parametro)
            ->with('imports', $imports)
            ->with('i', $i)
            ->with('municipios', $municipios)
            ->with('parroquias', $parroquias);
    }

    public function postRevision(Request $request, $id)
    {
        $parametros = Parametro::find($id);
        $import = ImportClap::find($request->id_clap);

        if (!$request->delete) {
            $claps = new Clap();
            $claps->nombre_clap = $import->nombre_clap;
            $claps->programa = $import->programa;
            $claps->municipios_id = $request->municipios_id;
            $claps->parroquias_id = $request->parroquias_id;
            $claps->comunidad = $import->comunidad;
            $claps->codigo_spda = $import->codigo_spda;
            $claps->codigo_sica = $import->codigo_sica;

            $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $request->municipios_id)->where('valor', $request->bloques_id)->first();
            if ($bloques) {
                $claps->bloques_id = $bloques->id;
            } else {
                $nuevo_bloque = new Parametro();
                $nuevo_bloque->nombre = "bloques";
                $nuevo_bloque->tabla_id = $request->municipios_id;
                $nuevo_bloque->valor = $request->bloques_id;
                $nuevo_bloque->save();
                $claps->bloques_id = $nuevo_bloque->id;
            }

            $claps->cedula_lider = $import->cedula_lider;
            $claps->primer_nombre_lider = $import->primer_nombre_lider;
            $claps->segundo_nombre_lider = $import->segundo_nombre_lider;
            $claps->primer_apellido_lider = $import->primer_apellido_lider;
            $claps->segundo_apellido_lider = $import->segundo_apellido_lider;
            $claps->nacionalidad_lider = $import->nacionalidad_lider;
            $claps->genero = $import->genero;
            $claps->fecha_nac_lider = $import->fecha_nac_lider;
            $claps->profesion_lider = $import->profesion_lider;
            $claps->trabajo_lider = $import->trabajo_lider;
            $claps->telefono_1_lider = $import->telefono_1_lider;
            $claps->telefono_2_lider = $import->telefono_2_lider;
            $claps->email_lider = $import->email_lider;
            $claps->estatus_lider = $import->estatus_lider;
            $claps->direccion = $import->direccion;
            $claps->longitud = $import->longitud;
            $claps->latitud = $import->latitud;
            $claps->google_maps = $import->google_maps;
            $claps->import_id = $parametros->id;
            if ($claps->save()) {
                $import->delete();
                flash('CLAPS Guardado Correctamente', 'success')->important();
            }

        } else {
            if ($request->todo) {
                $todos = ImportClap::where('import_id', $parametros->id)->get();
                foreach ($todos as $todo) {
                    $todo->delete();
                }
                flash('Todas las Filas han sido Eliminadas', 'danger')->important();
            } else {
                $import->delete();
                flash('Fila Eliminada', 'danger')->important();
            }


        }

        $verificar = ImportClap::where('import_id', $parametros->id)->first();
        if ($verificar) {
            return back();
        } else {
            return redirect()->route('claps.get_import', $parametros->id);
        }

    }

    public function exportImportClaps($id)
    {
        $imports = ImportClap::where('import_id', $id)->get();
        $parametro = Parametro::find($id);
        $nombre = fecha($parametro->created_at, 'd-m-Y_h-i_a');
        //return view('admin.claps.exports.import_claps')->with('imports', $imports);
        return Excel::download(new ImportClapsExport($imports), "Por_Revision_$nombre.xlsx");
    }

}
