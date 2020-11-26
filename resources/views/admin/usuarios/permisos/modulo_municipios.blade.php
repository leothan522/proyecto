<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Municipios</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="municipios_index" value="true" class="custom-control-input" type="checkbox" id="tituloMunicipios"
                           @if (leerJson($user->permisos, 'municipios.index')) checked @endif>
                    <label for="tituloMunicipios" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="municipios_store" value="true" class="custom-control-input" type="checkbox" id="tituloMunicipios2"
                       @if (leerJson($user->permisos, 'municipios.store')) checked @endif>
                <label for="tituloMunicipios2" class="custom-control-label">Crear Municipios</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="municipios_update" value="true" class="custom-control-input" type="checkbox" id="tituloMunicipios1"
                       @if (leerJson($user->permisos, 'municipios.update')) checked @endif>
                <label for="tituloMunicipios1" class="custom-control-label">Editar Municipios</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="municipios_destroy" value="true" class="custom-control-input" type="checkbox" id="tituloMunicipios3"
                       @if (leerJson($user->permisos, 'municipios.destroy')) checked @endif>
                <label for="tituloMunicipios3" class="custom-control-label">Eliminar Municipios</label>
            </div>

        </div>
    </div>
</div>
