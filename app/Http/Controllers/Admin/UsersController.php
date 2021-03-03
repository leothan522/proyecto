<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clave = Str::random(8);
        $users = User::orderBy('id', 'DESC')->paginate(30);
        return view('admin.usuarios.index')
            ->with('users', $users)
            ->with('clave', $clave);
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
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        //flash('Registrado Exitosamente', 'success')->important();
        verSweetAlert2('Usuario creado correctamente.');
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.usuarios.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.usuarios.permisos')
            ->with('user', $user);
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
        $user = User::find($id);

        switch ($request->mod) {

            case "status":
                if ($user->status > 0) {
                    $user->status = 0;
                    $tipo = "error";
                    $icono = '<i class="fas fa-user-slash"></i>';
                    $mensaje = 'Usuario Suspendido.';
                } else {
                    $user->status = 1;
                    $tipo = "success";
                    $icono = '<i class="fas fa-user-check"></i>';
                    $mensaje = 'Usuario activado.';
                }
                $user->save();
                //flash($mensaje, $tipo)->important();
                verSweetAlert2($mensaje, 'iconHtml', $tipo, $icono);
                return redirect()->route('usuarios.show', $id);
            break;

            case 'clave':
                $nueva_clave = Str::random(8);
                $user->password = Hash::make($nueva_clave);
                $user->update();
                verSweetAlert2('Nueva Contraseña generada correctamente', 'toast', 'success');
                return back()->with('nueva_clave', $nueva_clave);

            break;

            case "permisos":

                $permisos = [
                    'admin.dashboard'   => $request->input('admin_dashboard'),
                    'usuarios.index'    => $request->input('usuarios_index'),
                    'usuarios.store'    => $request->input('usuarios_store'),
                    'usuarios.status'    => $request->input('usuarios_status'),
                    'usuarios.editar'    => $request->input('usuarios_editar'),
                    'usuarios.clave'    => $request->input('usuarios_clave'),
                    'usuarios.edit'    => $request->input('usuarios_edit'),
                    'municipios.index'    => $request->input('municipios_index'),
                    'municipios.store'    => $request->input('municipios_store'),
                    'municipios.update'    => $request->input('municipios_update'),
                    'municipios.destroy'    => $request->input('municipios_destroy'),
                    'parroquias.index'    => $request->input('parroquias_index'),
                    'parroquias.store'    => $request->input('parroquias_store'),
                    'parroquias.update'    => $request->input('parroquias_update'),
                    'parroquias.destroy'    => $request->input('parroquias_destroy'),
                    'familias.index'    => $request->input('familias_index'),
                    'familias.store'    => $request->input('familias_store'),
                    'familias.update'    => $request->input('familias_update'),
                    'familias.destroy'    => $request->input('familias_destroy'),
                    'bloques.index'    => $request->input('bloques_index'),
                    'bloques.store'    => $request->input('bloques_store'),
                    'bloques.destroy'    => $request->input('bloques_destroy'),
                    'bloques.consultar'    => $request->input('bloques_consultar'),
                    'bloques.update'    => $request->input('bloques_update'),
                    'gestionar_claps'    => $request->input('gestionar_claps'),
                    'claps.index'    => $request->input('gestionar_claps'),
                    'claps.show'    => $request->input('gestionar_claps'),
                    'claps.create'    => $request->input('claps_create'),
                    'claps.store'    => $request->input('claps_create'),
                    'claps.edit'    => $request->input('claps_edit'),
                    'claps.update'    => $request->input('claps_edit'),
                    'claps.destroy'    => $request->input('claps_destroy'),
                    'claps.export'    => $request->input('claps_export'),
                    'claps.get_import'    => $request->input('claps_get_import'),
                    'claps.post_import'    => $request->input('claps_get_import'),
                    'claps.get_revision'    => $request->input('claps_get_import'),
                    'claps.post_revision'    => $request->input('claps_get_import'),
                    'claps.get_revision_export'    => $request->input('claps_get_import'),
                    'claps.borrar'    => $request->input('claps_borrar'),
                    'periodos.index'    => $request->input('periodos_index'),
                    'periodos.store'    => $request->input('periodos_store'),
                    'periodos.update'    => $request->input('periodos_update'),
                    'periodos.destroy'    => $request->input('periodos_destroy'),
                    'periodos.show'    => $request->input('periodos_show'),

                ];
                //******************************************** configuracion SIDEBAR
                if ($permisos['usuarios.index']){
                    $permisos['configuracion'] = "true";
                }else{
                    $permisos['configuracion'] = null;
                }
                //******************************************** ver Usuario / Suspender / Editar / Resstablecer Clave
                if ($permisos['usuarios.status'] || $permisos['usuarios.editar'] || $permisos['usuarios.clave']){
                    $permisos['usuarios.show'] = "true";
                    $permisos['usuarios.update'] = "true";
                }else{
                    $permisos['usuarios.show'] = null;
                    $permisos['usuarios.update'] = null;
                }
                //******************************************** Permisos de Usuario
                if ($permisos['usuarios.edit']){
                    $permisos['usuarios.update'] = "true";
                }

                //******************************************** parametros SIDEBAR
                if ($permisos['municipios.index'] || $permisos['parroquias.index'] || $permisos['familias.index'] || $permisos['bloques.index']){
                    $permisos['parametros'] = "true";
                }else{
                    $permisos['parametros'] = null;
                }

                //******************************************* Gestionar BLoques
                if ($permisos['bloques.consultar'] || $permisos['periodos.index']){
                    $permisos['gestionar_bloques'] = "true";
                }else{
                    $permisos['gestionar_bloques'] = null;
                }

                $permisos = json_encode($permisos);
                if ($permisos == $user->permisos){
                    verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                    return back();
                }
                $user->permisos = $permisos;
                $user->update();
                //flash('Permisos Actualizados', 'primary')->important();
                verSweetAlert2('Permisos del usuario actualizados.');
                return back();

            break;

            default:

                $rules = [
                    'name'      => 'required|min:8',
                    'email'     => ['required', 'email', Rule::unique('users')->ignore($id),],
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()){
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $name = $user->name;
                $email = $user->email;
                $role = $user->role;
                $plataforma = $user->plataforma;

                if ($plataforma == 0){
                    //Navegador
                    if ($name == $request->name && $email == $request->email && $role == $request->role){
                        //flash('No se realizo ningun cambio', 'warning')->important();
                        verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                        return back();
                    }else{

                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->role = $request->role;
                        if ($email != $request->email){
                            $user->status = 1;
                        }
                        $user->update();
                        //flash('Datos guardados correctamente', 'success')->important();
                        verSweetAlert2('Cambios guardados correctamente.');
                        return back();

                    }

                }else{
                    //android

                    if ($role == $request->role){
                        //flash('No se realizo ningun cambio', 'warning')->important();
                        verSweetAlert2('No se realizo ningun cambio.', 'toast', 'warning');
                        return back();
                    }else{

                        $user->role = $request->role;
                        $user->update();
                        //flash('Datos guardados correctamente', 'success')->important();
                        verSweetAlert2('Cambios guardados correctamente.');
                        return back();

                    }

                }





            break;
        }

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
}
