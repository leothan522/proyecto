<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">bloques</h3>

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
                Ver bloques
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'bloques.index')"
                           @if(leerJson($user_permisos, 'bloques.index')) checked @endif
                           class="custom-control-input" id="customSwitch0bloques">
                    <label class="custom-control-label" for="customSwitch0bloques"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear bloques
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'bloques.store')"
                           @if(leerJson($user_permisos, 'bloques.store')) checked @endif
                           class="custom-control-input" id="customSwitch1bloques">
                    <label class="custom-control-label" for="customSwitch1bloques"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar bloques
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'bloques.update')"
                           @if(leerJson($user_permisos, 'bloques.update')) checked @endif
                           class="custom-control-input" id="customSwitch2bloques">
                    <label class="custom-control-label" for="customSwitch2bloques"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar bloques
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'bloques.destroy')"
                           @if(leerJson($user_permisos, 'bloques.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch3bloques">
                    <label class="custom-control-label" for="customSwitch3bloques"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
