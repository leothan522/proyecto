<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Familias</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="familias_index" value="true" class="custom-control-input" type="checkbox" id="familias"
                           @if (leerJson($user->permisos, 'familias.index')) checked @endif>
                    <label for="familias" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="familias_store" value="true" class="custom-control-input" type="checkbox" id="familias2"
                       @if (leerJson($user->permisos, 'familias.store')) checked @endif>
                <label for="familias2" class="custom-control-label">Crear Parametro</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="familias_update" value="true" class="custom-control-input" type="checkbox" id="familias3"
                       @if (leerJson($user->permisos, 'familias.update')) checked @endif>
                <label for="familias3" class="custom-control-label">Editar Parametro</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="familias_destroy" value="true" class="custom-control-input" type="checkbox" id="familias4"
                       @if (leerJson($user->permisos, 'familias.destroy')) checked @endif>
                <label for="familias4" class="custom-control-label">Eliminar Parametro</label>
            </div>

        </div>
    </div>
</div>
