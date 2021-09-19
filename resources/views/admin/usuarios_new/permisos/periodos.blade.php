<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Periodos de Atención</h3>

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
                Ver Periodos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.index')"
                           @if(leerJson($user_permisos, 'periodos.index')) checked @endif
                           class="custom-control-input" id="customSwitch0periodos">
                    <label class="custom-control-label" for="customSwitch0periodos"></label>
                </div>
            </li>
            <li class="list-group-item">
                Ver Historico
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.edit')"
                           @if(leerJson($user_permisos, 'periodos.edit')) checked @endif
                           class="custom-control-input" id="customSwitch5periodos">
                    <label class="custom-control-label" for="customSwitch5periodos"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.store')"
                           @if(leerJson($user_permisos, 'periodos.store')) checked @endif
                           class="custom-control-input" id="customSwitch1periodos">
                    <label class="custom-control-label" for="customSwitch1periodos"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.update')"
                           @if(leerJson($user_permisos, 'periodos.update')) checked @endif
                           class="custom-control-input" id="customSwitch2periodos">
                    <label class="custom-control-label" for="customSwitch2periodos"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.destroy')"
                           @if(leerJson($user_permisos, 'periodos.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch3periodos">
                    <label class="custom-control-label" for="customSwitch3periodos"></label>
                </div>
            </li>
            <li class="list-group-item">
                Filtrar Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'periodos.show')"
                           @if(leerJson($user_permisos, 'periodos.show')) checked @endif
                           class="custom-control-input" id="customSwitch4periodos">
                    <label class="custom-control-label" for="customSwitch4periodos"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
