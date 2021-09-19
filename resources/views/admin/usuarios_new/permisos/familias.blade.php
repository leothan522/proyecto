<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Familias</h3>

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
                Ver Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'familias.index')"
                           @if(leerJson($user_permisos, 'familias.index')) checked @endif
                           class="custom-control-input" id="customSwitch0familias">
                    <label class="custom-control-label" for="customSwitch0familias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'familias.store')"
                           @if(leerJson($user_permisos, 'familias.store')) checked @endif
                           class="custom-control-input" id="customSwitch1familias">
                    <label class="custom-control-label" for="customSwitch1familias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'familias.update')"
                           @if(leerJson($user_permisos, 'familias.update')) checked @endif
                           class="custom-control-input" id="customSwitch2familias">
                    <label class="custom-control-label" for="customSwitch2familias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar Parametro
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'familias.destroy')"
                           @if(leerJson($user_permisos, 'familias.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch3familias">
                    <label class="custom-control-label" for="customSwitch3familias"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
