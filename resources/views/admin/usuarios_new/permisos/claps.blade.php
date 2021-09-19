<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Gestionar CLAPS</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0" wire:ignore.self>

        <ul class="list-group text-sm">
            <li class="list-group-item">
                Ver CLAPS
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.index')"
                           @if(leerJson($user_permisos, 'claps.index')) checked @endif
                           class="custom-control-input" id="customSwitch0claps">
                    <label class="custom-control-label" for="customSwitch0claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear CLAPS
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.create')"
                           @if(leerJson($user_permisos, 'claps.create')) checked @endif
                           class="custom-control-input" id="customSwitch1claps">
                    <label class="custom-control-label" for="customSwitch1claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar CLAPS
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.edit')"
                           @if(leerJson($user_permisos, 'claps.edit')) checked @endif
                           class="custom-control-input" id="customSwitch2claps">
                    <label class="custom-control-label" for="customSwitch2claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar claps
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.destroy')"
                           @if(leerJson($user_permisos, 'claps.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch6claps">
                    <label class="custom-control-label" for="customSwitch6claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Exportar CLAPS
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.export')"
                           @if(leerJson($user_permisos, 'claps.export')) checked @endif
                           class="custom-control-input" id="customSwitch3claps">
                    <label class="custom-control-label" for="customSwitch3claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Importar CLAPS
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.get_import')"
                           @if(leerJson($user_permisos, 'claps.get_import')) checked @endif
                           class="custom-control-input" id="customSwitch4claps">
                    <label class="custom-control-label" for="customSwitch4claps"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar CLAPS Municipio
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'claps.borrar')"
                           @if(leerJson($user_permisos, 'claps.borrar')) checked @endif
                           class="custom-control-input" id="customSwitch5claps">
                    <label class="custom-control-label" for="customSwitch5claps"></label>
                </div>
            </li>

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
