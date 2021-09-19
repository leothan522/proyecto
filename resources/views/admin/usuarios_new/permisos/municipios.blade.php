<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Municipios</h3>

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
                Ver Municipios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'municipios.index')"
                           @if(leerJson($user_permisos, 'municipios.index')) checked @endif
                           class="custom-control-input" id="customSwitch0municipios">
                    <label class="custom-control-label" for="customSwitch0municipios"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear municipios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'municipios.store')"
                           @if(leerJson($user_permisos, 'municipios.store')) checked @endif
                           class="custom-control-input" id="customSwitch1municipios">
                    <label class="custom-control-label" for="customSwitch1municipios"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar municipios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'municipios.update')"
                           @if(leerJson($user_permisos, 'municipios.update')) checked @endif
                           class="custom-control-input" id="customSwitch2municipios">
                    <label class="custom-control-label" for="customSwitch2municipios"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar Municipios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'municipios.destroy')"
                           @if(leerJson($user_permisos, 'municipios.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch3municipios">
                    <label class="custom-control-label" for="customSwitch3municipios"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
