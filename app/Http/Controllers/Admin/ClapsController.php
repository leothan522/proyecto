<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ImportClapsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClapsRequest;
use App\Imports\CensoImport;
use App\Imports\ClapsCensoImport;
use App\Imports\ClapsImport;
use App\Imports\LideresImport;
use App\Models\Censo;
use App\Models\Clap;
use App\Models\ImportClap;
use App\Models\Lider;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Exception;
use Validator;
//use mysql_xdevapi\Exception;

class ClapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parroquias = [];
        $bloques = [];
        $resultado = null;
        $id_municipio = null;
        $id_parroquia = null;
        $id_bloque = null;
        $nombre_clap = null;
        $codigo_sica = null;
        $cedula_lider = null;
        $ver_resultados = null;
        $claps_estadal = null;
        $claps_municipal = null;
        $claps_mun = null;

        $total_claps = Clap::count();
        $estadal = Parametro::where('nombre', 'claps_estadal')->first();
        if ($estadal){ $claps_estadal = $estadal->valor; }
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

        //JSON Bloques
        $i = 0;
        $json_bloques_valor[] = null;
        $json_bloques_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $items = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->get();
            foreach ($items as $item) {
                array_push($array_valor, $item->valor);
                array_push($array_id, $item->id);
            }
            $json_bloques_valor[$i] = $array_valor;
            $json_bloques_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }


        if ($request->buscar){
            if ($request->municipios_id == null && $request->parroquias_id == null && $request->bloques_id == null
                && $request->nombre_clap == null && $request->codigo_sica == null && $request->cedula_lider == null){
                //flash('Debes definir al menos un parametro para la Buscqueda', 'warning')->important();
                verSweetAlert2('Debes definir al menos un parametro para la Buscqueda', 'toast', 'warning');
                $resultado = null;
            }else{
                $id_municipio = $request->municipios_id;
                $parroquias = Parroquia::where('municipios_id', $id_municipio)->pluck('nombre_completo', 'id');
                $id_parroquia = $request->parroquias_id;
                $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $id_municipio)->pluck('valor', 'id');
                $id_bloque = $request->bloques_id;
                $nombre_clap = $request->nombre_clap;
                $codigo_sica = $request->codigo_sica;
                $cedula_lider = $request->cedula_lider;
                $resultado = true;

                if ($codigo_sica && $cedula_lider){
                    $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                        return $ver_resultados->where('municipios_id', $id_municipio);
                    })
                        ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                        return $ver_resultados->where('parroquias_id', $id_parroquia);
                    })
                        ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                            return $ver_resultados->where('bloques_id', $id_bloque);
                        })
                        /*where('municipios_id', 'LIKE', $id_municipio)*/
                        /*->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')*/
                        /*->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                        ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                        ->where('codigo_sica', 'LIKE', '%'.$codigo_sica.'%')
                        ->where('cedula_lider', 'LIKE', '%'.$cedula_lider.'%')
                        ->get();
                }
                if (!$codigo_sica && $cedula_lider){
                    $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                        return $ver_resultados->where('municipios_id', $id_municipio);
                    })
                        ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                            return $ver_resultados->where('parroquias_id', $id_parroquia);
                        })
                        ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                            return $ver_resultados->where('bloques_id', $id_bloque);
                        })
                        /*where('municipios_id', 'LIKE', $id_municipio)*/
                        /*->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')*/
                        /*->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                        ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                        ->where('cedula_lider', 'LIKE', '%'.$cedula_lider.'%')
                        ->get();
                }
                if ($codigo_sica && !$cedula_lider){
                    $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                        return $ver_resultados->where('municipios_id', $id_municipio);
                    })
                        ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                            return $ver_resultados->where('parroquias_id', $id_parroquia);
                        })
                        ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                            return $ver_resultados->where('bloques_id', $id_bloque);
                        })
                        /*where('municipios_id', 'LIKE', '%'.$id_municipio.'%')*/
                        /*->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')*/
                        /*->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                        ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                        ->where('codigo_sica', 'LIKE', '%'.$codigo_sica.'%')
                        ->get();
                }
                if (!$codigo_sica && !$cedula_lider){
                    $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                        return $ver_resultados->where('municipios_id', $id_municipio);
                    })
                        ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                            return $ver_resultados->where('parroquias_id', $id_parroquia);
                        })
                        ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                            return $ver_resultados->where('bloques_id', $id_bloque);
                        })
                        /*->where('municipios_id', 'LIKE', '%'.$id_municipio.'%')*/
                        /*->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')*/
                        /*->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                        ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                        ->get();
                }


                if ($id_municipio){
                    $claps_municipal = Parametro::where('nombre', 'claps')->where('tabla_id', $id_municipio)->first();
                    if ($claps_municipal){ $claps_municipal = $claps_municipal->valor; }
                    $claps_mun = Clap::where('municipios_id', $id_municipio)->count();
                }



            }

        }


        return view('admin.claps.index')
            ->with('total_claps', $total_claps)
            ->with('claps_estadal', $claps_estadal)
            ->with('claps_municipal', $claps_municipal)
            ->with('claps_mun', $claps_mun)
            ->with('municipios', $select_municipios)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('json_bloques_valor', $json_bloques_valor)
            ->with('json_bloques_id', $json_bloques_id)
            ->with('resultado', $resultado)
            ->with('id_municipio', $id_municipio)
            ->with('id_parroquia', $id_parroquia)
            ->with('id_bloque', $id_bloque)
            ->with('nombre_clap', $nombre_clap)
            ->with('codigo_sica', $codigo_sica)
            ->with('cedula_lider', $cedula_lider)
            ->with('ver_resultados', $ver_resultados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parroquias = [];
        $bloques = [];

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

        //JSON Bloques
        $i = 0;
        $json_bloques_valor[] = null;
        $json_bloques_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $items = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->get();
            foreach ($items as $item) {
                array_push($array_valor, $item->valor);
                array_push($array_id, $item->id);
            }
            $json_bloques_valor[$i] = $array_valor;
            $json_bloques_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }

        return view('admin.claps.create')
            ->with('municipios', $select_municipios)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('json_bloques_valor', $json_bloques_valor)
            ->with('json_bloques_id', $json_bloques_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClapsRequest $request)
    {
        $clap = new Clap($request->all());
        $clap->save();
        flash('CLAP Guardado Exitosamente', 'success')->important();
        return redirect()->route('claps.edit', $clap->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id = "datos-cargados") {

            $claps_estadal = null;

            $total_claps = Clap::count();
            $estadal = Parametro::where('nombre', 'claps_estadal')->first();
            if ($estadal){ $claps_estadal = $estadal->valor; }

            $estadal_lideres = Clap::sum('num_lideres');
            $estadal_familias = Clap::sum('num_familias');
            $estadal_lid_cargados = Lider::count();
            $estadal_fam_cargados = Censo::where('miembro_familia', 'Jefe de Familia')->count();


            $municipios = Municipio::orderBy('nombre_corto', 'ASC')->get();
            $municipios->each(function ($municipio){

                $claps = Clap::where('municipios_id', $municipio->id)->count();
                $municipio->claps = $claps;

                $lideres = Clap::where('municipios_id', $municipio->id)->sum('num_lideres');
                $lid_cargados = Lider::where('municipios_id', $municipio->id)->count();
                $municipio->lideres = $lideres;
                $municipio->lid_cargados = $lid_cargados;

                $familias = Clap::where('municipios_id', $municipio->id)->sum('num_familias');
                $fam_cargados = Censo::where('municipios_id', $municipio->id)->where('miembro_familia', 'Jefe de Familia')->count();
                $municipio->familias = $familias;
                $municipio->fam_cargados = $fam_cargados;

                $claps_municipal = Parametro::where('nombre', 'claps')->where('tabla_id', $municipio->id)->first();
                if ($claps_municipal){
                    $municipio->total_claps = $claps_municipal->valor;
                }else{
                    $municipio->total_claps = 0;
                }

            });

            return view('admin.claps.datos_cargados')
                ->with('total_claps', $total_claps)
                ->with('claps_estadal', $claps_estadal)
                ->with('municipios', $municipios)
                ->with('total_lideres', $estadal_lideres)
                ->with('lid_cargados', $estadal_lid_cargados)
                ->with('total_familias', $estadal_familias)
                ->with('fam_cargados', $estadal_fam_cargados);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parroquias = [];
        $bloques = [];

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

        //JSON Bloques
        $i = 0;
        $json_bloques_valor[] = null;
        $json_bloques_id[] = null;
        foreach ($municipios as $municipio) {
            $i++;
            $array_valor[] = "Seleccione";
            $array_id[] = "";
            $items = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->get();
            foreach ($items as $item) {
                array_push($array_valor, $item->valor);
                array_push($array_id, $item->id);
            }
            $json_bloques_valor[$i] = $array_valor;
            $json_bloques_id[$i] = $array_id;
            unset($array_valor);
            unset($array_id);
        }

        $clap = Clap::find($id);
        $parroquias = Parroquia::where('municipios_id', $clap->municipios_id)->pluck('nombre_completo', 'id');
        $bloques = Parametro::where('nombre', 'bloques')->where('tabla_id', $clap->municipios_id)->pluck('valor', 'id');

        return view('admin.claps.edit')
            ->with('municipios', $select_municipios)
            ->with('parroquias', $parroquias)
            ->with('bloques', $bloques)
            ->with('json_parroquias_valor', $json_parroquias_valor)
            ->with('json_parroquias_id', $json_parroquias_id)
            ->with('json_bloques_valor', $json_bloques_valor)
            ->with('json_bloques_id', $json_bloques_id)
            ->with('clap', $clap);
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
        $rules = [
            'programa' => 'required',
            'municipios_id' => 'required',
            'parroquias_id' => 'required',
            'bloques_id' => 'required',
            'nombre_clap' => 'required|min:4',
            'comunidad' => 'required|min:4',
            'codigo_sica' => ['required', Rule::unique('claps')->ignore($id),]
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $clap = Clap::find($id);
        $clap->fill($request->all());
        $clap->update();

        flash('Cambios Guardados Correctamente', 'primary')->important();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clap = Clap::find($id);
        $nombre = strtoupper($clap->nombre_clap);
        $clap->delete();
        //flash('CLAP Eliminado Exitosamente', 'danger')->important();
        verSweetAlert2("Borrado el CLAP <strong class='text-danger'>$nombre</strong>", 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
        return back();
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
                $claps->municipios_id = $municipio->id;
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

        $validar = Clap::where('import_id', $parametros->id)->count();
        if ($validar){
            $message = "Data importada correctamente.";
            verSweetAlert2($message);
            return redirect()->route('claps.get_import', $parametros->id);
        }else{
            //$parametros->delete();
            $validar = ImportClap::where('import_id', $parametros->id)->count();
            if ($validar){
                $message = "Data importada con Observaciones.";
                verSweetAlert2($message);
                return redirect()->route('claps.get_import', $parametros->id);
            }else{
                $parametros->delete();
                $title = "¡Error!";
                $message = "El archivo que intentas subir no cumple con el formato establecido para la carga de los CLAPS";
                verSweetAlert2($message, 'iconHtml', 'error', '<i class="fa fa-ban"></i>', $title);
                return back();
            }

        }
        //flash('Importado Exitosamente', 'success')->important();
        //return redirect()->route('claps.get_import', $parametros->id);
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
                //flash('CLAPS Guardado Correctamente', 'success')->important();
                verSweetAlert2('CLAP Guardado correctamente.');
            }

        } else {
            if ($request->todo) {
                $todos = ImportClap::where('import_id', $parametros->id)->get();
                foreach ($todos as $todo) {
                    $todo->delete();
                }
                //flash('Todas las Filas han sido Eliminadas', 'danger')->important();
                verSweetAlert2('Todas las Filas han sido Borradas.', 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
            } else {
                $nombre = $import->nombre_clap;
                $import->delete();
                //flash('Fila Eliminada', 'danger')->important();
                verSweetAlert2("Borrada la fila <strong class='text-danger'>$nombre</strong>", 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
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
        if ($id){
            $nombre = fecha($parametro->created_at, 'd-m-Y_h-i_a');
            //return view('admin.claps.exports.import_claps')->with('imports', $imports);
            return Excel::download(new ImportClapsExport($imports, true), "Por_Revision_$nombre.xlsx");
        }else{
            $nombre = "Formato_Import_CLAPS";
            //return view('admin.claps.exports.import_claps')->with('imports', $imports);
            return Excel::download(new ImportClapsExport($imports), "$nombre.xlsx");
        }

    }

    public function exportClaps(Request $request)
    {
        $id_municipio = $request->municipios_id;
        $id_parroquia = $request->parroquias_id;
        $id_bloque = $request->bloques_id;
        $nombre_clap = $request->nombre_clap;
        $codigo_sica = $request->codigo_sica;
        $cedula_lider = $request->cedula_lider;
        $municipio = null;

        if ($codigo_sica && $cedula_lider){
            $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                return $ver_resultados->where('municipios_id', $id_municipio);
            })
                ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                    return $ver_resultados->where('parroquias_id', $id_parroquia);
                })
                ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                    return $ver_resultados->where('bloques_id', $id_bloque);
                })/*where('municipios_id', 'LIKE', '%'.$id_municipio.'%')
                ->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')
                ->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                ->where('codigo_sica', 'LIKE', '%'.$codigo_sica.'%')
                ->where('cedula_lider', 'LIKE', '%'.$cedula_lider.'%')
                ->get();
        }
        if (!$codigo_sica && $cedula_lider){
            $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                return $ver_resultados->where('municipios_id', $id_municipio);
            })
                ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                    return $ver_resultados->where('parroquias_id', $id_parroquia);
                })
                ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                    return $ver_resultados->where('bloques_id', $id_bloque);
                })/*where('municipios_id', 'LIKE', '%'.$id_municipio.'%')
                ->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')
                ->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                ->where('cedula_lider', 'LIKE', '%'.$cedula_lider.'%')
                ->get();
        }
        if ($codigo_sica && !$cedula_lider){
            $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                return $ver_resultados->where('municipios_id', $id_municipio);
            })
                ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                    return $ver_resultados->where('parroquias_id', $id_parroquia);
                })
                ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                    return $ver_resultados->where('bloques_id', $id_bloque);
                })/*where('municipios_id', 'LIKE', '%'.$id_municipio.'%')
                ->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')
                ->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                ->where('codigo_sica', 'LIKE', '%'.$codigo_sica.'%')
                ->get();
        }
        if (!$codigo_sica && !$cedula_lider){
            $ver_resultados = Clap::when($request->municipios_id, function ($ver_resultados) use ($id_municipio) {
                return $ver_resultados->where('municipios_id', $id_municipio);
            })
                ->when($request->parroquias_id, function ($ver_resultados) use ($id_parroquia) {
                    return $ver_resultados->where('parroquias_id', $id_parroquia);
                })
                ->when($request->bloques_id, function ($ver_resultados) use ($id_bloque) {
                    return $ver_resultados->where('bloques_id', $id_bloque);
                })/*where('municipios_id', 'LIKE', '%'.$id_municipio.'%')
                ->where('parroquias_id', 'LIKE', '%'.$id_parroquia.'%')
                ->where('bloques_id', 'LIKE', '%'.$id_bloque.'%')*/
                ->where('nombre_clap', 'LIKE', '%'.$nombre_clap.'%')
                ->get();
        }

        if ($request->datos_cargados){
            $municipio = Municipio::find($id_municipio);
            $municipio = $municipio->nombre_corto;
        }
        //return view('admin.claps.exports.claps')->with('imports', $ver_resultados);
        $nombre = "Export_Clap_".$municipio."_".date('d-m-Y');
        //verSweetAlert2('hola');
        return Excel::download(new ImportClapsExport($ver_resultados), "$nombre.xlsx");

    }

    public function borrarMunicipio($id_municipio)
    {
        $municipio = Municipio::find($id_municipio);
        $claps = Clap::where('municipios_id', $id_municipio)->get();
        foreach ($claps as $clap){
            $clap->delete();
        }
        verSweetAlert2("Borrados los CLAPS del Municipio <strong class='text-danger'>$municipio->nombre_completo</strong>", 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
        return back();
    }

    public function formatoExcel()
    {
        $url  = public_path()."/files/FORMATO_APP.xlsx";
        return response()->download($url);
    }

    public function verLideres($id)
    {
        $clap = Clap::find($id);
        $lideres = Lider::where('claps_id', $clap->id)->get();
        $estructura = Censo::where('claps_id', $id)->where('estructura_clap', '!=', null)->get();
        $censo = Censo::where('claps_id', $clap->id)->where('miembro_familia', 'Jefe de Familia')->count();

        return view('admin.claps.ver_lideres')
            ->with('clap', $clap)
            ->with('lideres', $lideres)
            ->with('estructura', $estructura)
            ->with('familias', $censo)
            ->with('i', 0);
    }

    public function verCenso($id)
    {
        $clap = Clap::find($id);
        $lideres = Lider::where('claps_id', $clap->id)->count();
        $censo = Censo::where('claps_id', $clap->id)->where('miembro_familia', 'Jefe de Familia')->get();
        return view('admin.claps.ver_censo')
            ->with('clap', $clap)
            ->with('lideres', $lideres)
            ->with('censos', $censo)
            ->with('familias', $censo->count())
            ->with('i', 0);
    }

    public function importCenso(Request $request, $id)
    {
        $parametros = new Parametro();
        $parametros->nombre = "import_censo";
        $parametros->valor = Auth::user()->id;
        $parametros->save();

        Excel::import(new ClapsCensoImport($id, $parametros->id), $request->file('excel'));

        $validar = Lider::where('import_id', $parametros->id)->count();
        if ($validar){
            $message = "Data importada correctamente.";
            verSweetAlert2($message);
            return redirect()->route('claps.lideres', $id);
        }else{
            $validar = Censo::where('import_id', $parametros->id)->count();
            if ($validar){
                $message = "Data importada correctamente.";
                verSweetAlert2($message);
                return redirect()->route('claps.censo', $id);
            }else{
                $parametros->delete();
                $title = "¡Error!";
                $message = "El archivo que intentas subir no cumple con el formato establecido para la carga de los CLAPS";
                verSweetAlert2($message, 'iconHtml', 'error', '<i class="fa fa-ban"></i>', $title);
                return back();
            }
        }

    }

    public function deleteCenso($id)
    {
        $clap = Clap::find($id);
        $lideres = Lider::where('claps_id', $id)->get();
        foreach ($lideres as $lider){
            $lider->delete();
        }

        $censos = Censo::where('claps_id', $id)->get();
        foreach ($censos as $censo){
            $censo->delete();
        }

        verSweetAlert2("Borrado TODO del CLAPS: <strong class='text-danger'>$clap->nombre_clap</strong>", 'iconHtml', 'error', '<i class="fa fa-trash"></i>');
        return back();

    }


}
