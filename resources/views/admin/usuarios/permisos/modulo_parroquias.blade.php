<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Parroquias</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="parroquias_index" value="true" class="custom-control-input" type="checkbox" id="Parroquias"
                           @if (leerJson($user->permisos, 'parroquias.index')) checked @endif>
                    <label for="Parroquias" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="parroquias_store" value="true" class="custom-control-input" type="checkbox" id="Parroquias2"
                       @if (leerJson($user->permisos, 'parroquias.store')) checked @endif>
                <label for="Parroquias2" class="custom-control-label">Crear Parroquias</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="parroquias_update" value="true" class="custom-control-input" type="checkbox" id="Parroquias3"
                       @if (leerJson($user->permisos, 'parroquias.update')) checked @endif>
                <label for="Parroquias3" class="custom-control-label">Editar Parroquias</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="parroquias_destroy" value="true" class="custom-control-input" type="checkbox" id="Parroquias4"
                       @if (leerJson($user->permisos, 'parroquias.destroy')) checked @endif>
                <label for="Parroquias4" class="custom-control-label">Eliminar Parroquias</label>
            </div>

        </div>
    </div>
</div>
