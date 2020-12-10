<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Gestionar CLAPS</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="gestionar_claps" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps"
                           @if (leerJson($user->permisos, 'gestionar_claps')) checked @endif>
                    <label for="GestionarClaps" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="claps_create" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps3"
                       @if (leerJson($user->permisos, 'claps.create')) checked @endif>
                <label for="GestionarClaps3" class="custom-control-label">Crear CLAPS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="claps_edit" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps4"
                       @if (leerJson($user->permisos, 'claps.edit')) checked @endif>
                <label for="GestionarClaps4" class="custom-control-label">Editar CLAPS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="claps_destroy" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps5"
                       @if (leerJson($user->permisos, 'claps.destroy')) checked @endif>
                <label for="GestionarClaps5" class="custom-control-label">Eliminar CLAPS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="claps_export" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps6"
                       @if (leerJson($user->permisos, 'claps.export')) checked @endif>
                <label for="GestionarClaps6" class="custom-control-label">Exportar CLAPS</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="claps_get_import" value="true" class="custom-control-input" type="checkbox" id="GestionarClaps2"
                       @if (leerJson($user->permisos, 'claps.get_import')) checked @endif>
                <label for="GestionarClaps2" class="custom-control-label">Importar CLAPS</label>
            </div>

        </div>
    </div>
</div>
