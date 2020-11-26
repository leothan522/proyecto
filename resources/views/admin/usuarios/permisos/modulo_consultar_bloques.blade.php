<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Consultar Bloques</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="bloques_consultar" value="true" class="custom-control-input" type="checkbox" id="Gestionar_Bloque"
                           @if (leerJson($user->permisos, 'bloques.consultar')) checked @endif>
                    <label for="Gestionar_Bloque" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="bloques_update" value="true" class="custom-control-input" type="checkbox" id="Gestionar_Bloque2"
                       @if (leerJson($user->permisos, 'bloques.update')) checked @endif>
                <label for="Gestionar_Bloque2" class="custom-control-label">Editar Bloques</label>
            </div>

        </div>
    </div>
</div>
