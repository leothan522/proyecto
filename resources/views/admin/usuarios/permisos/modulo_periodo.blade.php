<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Periodos de Atención</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="periodos_index" value="true" class="custom-control-input" type="checkbox" id="periodos"
                           @if (leerJson($user->permisos, 'periodos.index')) checked @endif>
                    <label for="periodos" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="periodos_store" value="true" class="custom-control-input" type="checkbox" id="periodos2"
                       @if (leerJson($user->permisos, 'periodos.store')) checked @endif>
                <label for="periodos2" class="custom-control-label">Crear Parametro</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="periodos_update" value="true" class="custom-control-input" type="checkbox" id="periodos3"
                       @if (leerJson($user->permisos, 'periodos.update')) checked @endif>
                <label for="periodos3" class="custom-control-label">Editar Parametro</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="periodos_destroy" value="true" class="custom-control-input" type="checkbox" id="periodos4"
                       @if (leerJson($user->permisos, 'periodos.destroy')) checked @endif>
                <label for="periodos4" class="custom-control-label">Eliminar Parametro</label>
            </div>

        </div>
    </div>
</div>
