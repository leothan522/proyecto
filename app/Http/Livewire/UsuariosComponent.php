<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class UsuariosComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
    ];

    public $name, $email, $password, $role, $busqueda;
    public $user_id, $user_name, $user_email, $user_password, $user_role, $user_estatus, $user_fecha, $user_permisos;

    public function mount(Request $request)
    {
        if (!is_null($request->usuario)){
            $this->busqueda = $request->usuario;
        }
    }

    public function render()
    {
        $users = User::buscar($this->busqueda)->orderBy('id', 'DESC')->paginate(30);
        if ($users->isEmpty()){
            verSweetAlert2("Busqueda sin resultados", 'toast', null, 'error');
        }
        return view('livewire.usuarios-component')
            ->with('users', $users);
    }

    public function generarClave()
    {
        $this->password = Str::random(8);
    }

    public function limpiar()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->role = null;
        $this->user_id = null;
        $this->user_name = null;
        $this->user_email = null;
        $this->user_password = null;
        $this->user_role = null;
        $this->user_estatus = null;
        $this->user_fecha = null;
        $this->user_permisos = null;
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required|min:8',
            'role' => 'required'
        ];

        $this->validate($rules);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->password);
        $user->save();
        $this->alert(
            'success',
            'Usuario Creado'
        );
        $this->limpiar();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->user_email = $user->email;
        $this->user_role = $user->role;
        $this->user_estatus = $user->status;
        $this->user_fecha = $user->created_at;
    }

    public function update($id)
    {
        $rules = [
            'user_name' => 'required|min:4',
            'user_email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'user_role' => 'required'
        ];
        $this->validate($rules);
        $user = User::find($id);
        $user->name = $this->user_name;
        $user->email = $this->user_email;
        $user->role = $this->user_role;
        $user->save();
        $this->alert(
            'success',
            'Usuario Actualizado'
        );

    }

    public function cambiarEstatus($id)
    {
        $user = User::find($id);

        if ($user->status){
            $user->status = 0;
            $texto = "Usuario Suspendido";
        }else{
            $user->status = 1;
            $texto = "Usuario Activado";
        }

        $user->update();
        $this->user_estatus = $user->status;
        $this->alert(
            'success',
            $texto
        );
    }

    public function restablecerClave($id)
    {
        if (!$this->user_password){
            $clave = Str::random(8);
        }else{
            $clave = $this->user_password;
        }
        $user = User::find($id);
        $user->password = Hash::make($clave);
        $user->update();
        $this->user_password = $clave;
        $this->alert(
            'success',
            'Contraseña Restablecida'
        );
    }

    public function edit_permisos($id)
    {
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->user_name = $user->name;
        $this->user_permisos = $user->permisos;

    }

    public function update_permisos($id, $permiso)
    {
        $permisos = [];
        $user = User::find($id);
        if (!leerJson($user->permisos, $permiso)){
            $permisos = json_decode($user->permisos, true);
            $permisos[$permiso] = true;
            //$permisos = json_encode($permisos);
            $this->alert(
                'success',
                'Permiso Agregado'
            );
        }else{
            $permisos = json_decode($user->permisos, true);
            unset($permisos[$permiso]);
            //$permisos = json_encode($permisos);
            $this->alert(
                'success',
                'Permiso Eliminado'
            );
        }

        if (isset($permisos['usuarios.index']) && $permisos['usuarios.index'] == true){
            $permisos['configuracion'] = "true";
        }else{
            $permisos['configuracion'] = null;
        }

        //******************************************** parametros SIDEBAR
        if ((isset($permisos['municipios.index']) && $permisos['municipios.index'] == true) ||
            (isset($permisos['parroquias.index']) && $permisos['parroquias.index'] == true) ||
            (isset($permisos['familias.index']) && $permisos['familias.index'] == true) ||
            (isset($permisos['bloques.index']) && $permisos['bloques.index'] == true)){
            $permisos['parametros'] = "true";
        }else{
            $permisos['parametros'] = null;
        }

        //******************************************* Gestionar BLoques

        if (isset($permisos['bloques.index']) && $permisos['bloques.index'] == true){
            $permisos['bloques.consultar'] = "true";
        }else{
            $permisos['bloques.consultar'] = null;
        }

        if ((isset($permisos['bloques.consultar']) && $permisos['bloques.consultar'] == true) ||
            (isset($permisos['periodos.index']) && $permisos['periodos.index'] == true)){
            $permisos['gestionar_bloques'] = "true";
        }else{
            $permisos['gestionar_bloques'] = null;
        }

        //********************************************** CLAPS
        if (isset($permisos['claps.index']) && $permisos['claps.index'] == true){
            $permisos['gestionar_claps'] = "true";
            $permisos['claps.show'] = "true";
            $permisos['claps.lideres'] = "true";
            $permisos['claps.censo'] = "true";
            $permisos['claps.censo_import'] = "true";
            $permisos['claps.censo_delete'] = "true";
            $permisos['claps.formato'] = "true";
        }else{
            $permisos['gestionar_claps'] = null;
            $permisos['claps.show'] = null;
            $permisos['claps.lideres'] = null;
            $permisos['claps.censo'] = null;
            $permisos['claps.censo_import'] = null;
            $permisos['claps.censo_delete'] = null;
            $permisos['claps.formato'] = null;
        }

        if (isset($permisos['claps.create']) && $permisos['claps.create'] == true){
            $permisos['claps.store'] = "true";
        }else{
            $permisos['claps.store'] = null;
        }

        if (isset($permisos['claps.get_import']) && $permisos['claps.get_import'] == true){
            $permisos['claps.post_import'] = "true";
            $permisos['claps.get_revision'] = "true";
            $permisos['claps.post_revision'] = "true";
            $permisos['claps.get_revision_export'] = "true";
        }else{
            $permisos['claps.post_import'] = null;
            $permisos['claps.get_revision'] = null;
            $permisos['claps.post_revision'] = null;
            $permisos['claps.get_revision_export'] = null;
        }

        if (isset($permisos['claps.edit']) && $permisos['claps.edit'] == true){
            $permisos['claps.update'] = "true";
        }else{
            $permisos['claps.update'] = null;
        }

        //******************************************* Programas

        if (isset($permisos['ferias.index']) && $permisos['ferias.index'] == true){
            $permisos['ferias.edit'] = "true";
            $permisos['ferias.store'] = "true";
            $permisos['ferias.show'] = "true";
            $permisos['ferias.update'] = "true";
            $permisos['ferias.destroy'] = "true";
        }else{
            $permisos['ferias.edit'] = null;
            $permisos['ferias.store'] = null;
            $permisos['ferias.show'] = null;
            $permisos['ferias.update'] = null;
            $permisos['ferias.destroy'] = null;
        }

        if (isset($permisos['movil.index']) && $permisos['movil.index'] == true){
            $permisos['movil.edit'] = "true";
            $permisos['movil.store'] = "true";
            $permisos['movil.show'] = "true";
            $permisos['movil.update'] = "true";
            $permisos['movil.destroy'] = "true";
        }else{
            $permisos['movil.edit'] = null;
            $permisos['movil.store'] = null;
            $permisos['movil.show'] = null;
            $permisos['movil.update'] = null;
            $permisos['movil.destroy'] = null;
        }

        if (isset($permisos['fisica.index']) && $permisos['fisica.index'] == true){
            $permisos['fisica.edit'] = "true";
            $permisos['fisica.store'] = "true";
            $permisos['fisica.show'] = "true";
            $permisos['fisica.update'] = "true";
            $permisos['fisica.destroy'] = "true";
        }else{
            $permisos['fisica.edit'] = null;
            $permisos['fisica.store'] = null;
            $permisos['fisica.show'] = null;
            $permisos['fisica.update'] = null;
            $permisos['fisica.destroy'] = null;
        }

        if (isset($permisos['enlinea.index']) && $permisos['enlinea.index'] == true){
            $permisos['enlinea.edit'] = "true";
            $permisos['enlinea.store'] = "true";
            $permisos['enlinea.show'] = "true";
            $permisos['enlinea.update'] = "true";
            $permisos['enlinea.destroy'] = "true";
        }else{
            $permisos['enlinea.edit'] = null;
            $permisos['enlinea.store'] = null;
            $permisos['enlinea.show'] = null;
            $permisos['enlinea.update'] = null;
            $permisos['enlinea.destroy'] = null;
        }

        if (isset($permisos['proteico.index']) && $permisos['proteico.index'] == true){
            $permisos['proteico.edit'] = "true";
            $permisos['proteico.store'] = "true";
            $permisos['proteico.show'] = "true";
            $permisos['proteico.update'] = "true";
            $permisos['proteico.destroy'] = "true";
        }else{
            $permisos['proteico.edit'] = null;
            $permisos['proteico.store'] = null;
            $permisos['proteico.show'] = null;
            $permisos['proteico.update'] = null;
            $permisos['proteico.destroy'] = null;
        }

        if ((isset($permisos['ferias.index']) && $permisos['ferias.index'] == true) ||
            (isset($permisos['movil.index']) && $permisos['movil.index'] == true) ||
            (isset($permisos['fisica.index']) && $permisos['fisica.index'] = true) ||
            (isset($permisos['enlinea.index']) && $permisos['enlinea.index'] == true) ||
            (isset($permisos['proteico.index']) && $permisos['proteico.index'] ==true)){
            $permisos['programas'] = "true";
        }else{
            $permisos['programas'] = null;
        }


        $permisos = json_encode($permisos);
        $user->permisos = $permisos;
        $user->update();

    }

    public function destroy($id)
    {
        $this->user_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);

    }

    public function confirmed()
    {
        // Example code inside confirmed callback
        $user = User::find($this->user_id);
        $user->delete();
        $this->user_id = null;
        $this->alert(
            'success',
            'Usuario Eliminado'
        );

    }
}
