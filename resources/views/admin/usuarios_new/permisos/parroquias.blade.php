<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Parroquias</h3>

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
                Ver Parroquias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'parroquias.index')"
                           @if(leerJson($user_permisos, 'parroquias.index')) checked @endif
                           class="custom-control-input" id="customSwitch0parroquias">
                    <label class="custom-control-label" for="customSwitch0parroquias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Parroquias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'parroquias.store')"
                           @if(leerJson($user_permisos, 'parroquias.store')) checked @endif
                           class="custom-control-input" id="customSwitch1parroquias">
                    <label class="custom-control-label" for="customSwitch1parroquias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Parroquias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'parroquias.update')"
                           @if(leerJson($user_permisos, 'parroquias.update')) checked @endif
                           class="custom-control-input" id="customSwitch2parroquias">
                    <label class="custom-control-label" for="customSwitch2parroquias"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar Parroquias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'parroquias.destroy')"
                           @if(leerJson($user_permisos, 'parroquias.destroy')) checked @endif
                           class="custom-control-input" id="customSwitch3parroquias">
                    <label class="custom-control-label" for="customSwitch3parroquias"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
