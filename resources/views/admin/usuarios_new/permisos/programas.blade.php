<div class="card card-navy collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Gestionar Programas</h3>

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
                Ferias Campo Soberano
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'ferias.index')"
                           @if(leerJson($user_permisos, 'ferias.index')) checked @endif
                           class="custom-control-input" id="customSwitch0programas">
                    <label class="custom-control-label" for="customSwitch0programas"></label>
                </div>
            </li>
            <li class="list-group-item">
                Tienda Movil
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'movil.index')"
                           @if(leerJson($user_permisos, 'movil.index')) checked @endif
                           class="custom-control-input" id="customSwitch1programas">
                    <label class="custom-control-label" for="customSwitch1programas"></label>
                </div>
            </li>
            <li class="list-group-item">
                Tiendas Fisicas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'fisica.index')"
                           @if(leerJson($user_permisos, 'fisica.index')) checked @endif
                           class="custom-control-input" id="customSwitch3programas">
                    <label class="custom-control-label" for="customSwitch3programas"></label>
                </div>
            </li>
            <li class="list-group-item">
                Tiendas En Linea
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'enlinea.index')"
                           @if(leerJson($user_permisos, 'enlinea.index')) checked @endif
                           class="custom-control-input" id="customSwitch4programas">
                    <label class="custom-control-label" for="customSwitch4programas"></label>
                </div>
            </li>
            <li class="list-group-item">
                Plan Proteico
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'proteico.index')"
                           @if(leerJson($user_permisos, 'proteico.index')) checked @endif
                           class="custom-control-input" id="customSwitch5programas">
                    <label class="custom-control-label" for="customSwitch5programas"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
