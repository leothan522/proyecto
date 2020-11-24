<div class="col-md-3">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title">Usuarios</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="usuarios_index" value="true" class="custom-control-input" type="checkbox" id="tituloUsuarios"
                           @if (leerJson($user->permisos, 'usuarios.index')) checked @endif>
                    <label for="tituloUsuarios" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="usuarios_create" value="true" class="custom-control-input" type="checkbox" id="optionUsuarios1"
                @if (leerJson($user->permisos, 'usuarios.create')) checked @endif>
                <label for="optionUsuarios1" class="custom-control-label">Crear Usuarios</label>
            </div>
            <div class="custom-control custom-checkbox d-none">
                <input name="usuarios_store" value="true" class="custom-control-input" type="checkbox" id="optionUsuariosp1"
                       @if (leerJson($user->permisos, 'usuarios.store')) checked @endif>
                <label for="optionUsuariosp1" class="custom-control-label">usuarios.store</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="usuarios_status" value="true" class="custom-control-input" type="checkbox" id="optionUsuarios3"
                       @if (leerJson($user->permisos, 'usuarios.status')) checked @endif>
                <label for="optionUsuarios3" class="custom-control-label">[Suspender / Activar] Usuarios</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="usuarios_editar" value="true" class="custom-control-input" type="checkbox" id="optionUsuarios2"
                       @if (leerJson($user->permisos, 'usuarios.editar')) checked @endif>
                <label for="optionUsuarios2" class="custom-control-label">Editar Usuarios</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="usuarios_clave" value="true" class="custom-control-input" type="checkbox" id="optionUsuarios4"
                       @if (leerJson($user->permisos, 'usuarios.clave')) checked @endif>
                <label for="optionUsuarios4" class="custom-control-label">Reestablecer Contraseña</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="usuarios_edit" value="true" class="custom-control-input" type="checkbox" id="optionUsuarios5"
                       @if (leerJson($user->permisos, 'usuarios.edit')) checked @endif>
                <label for="optionUsuarios5" class="custom-control-label">Permisos de Usuario</label>
            </div>


        </div>
    </div>
</div>
