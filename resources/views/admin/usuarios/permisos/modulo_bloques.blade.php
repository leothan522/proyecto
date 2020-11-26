<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Bloques</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="bloques_index" value="true" class="custom-control-input" type="checkbox" id="Bloque"
                           @if (leerJson($user->permisos, 'bloques.index')) checked @endif>
                    <label for="Bloque" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="bloques_store" value="true" class="custom-control-input" type="checkbox" id="Bloque2"
                       @if (leerJson($user->permisos, 'bloques.store')) checked @endif>
                <label for="Bloque2" class="custom-control-label">Crear Bloques</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="bloques_destroy" value="true" class="custom-control-input" type="checkbox" id="Bloque4"
                       @if (leerJson($user->permisos, 'bloques.destroy')) checked @endif>
                <label for="Bloque4" class="custom-control-label">Eliminar Bloques</label>
            </div>

        </div>
    </div>
</div>
