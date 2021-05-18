<div class="col-md-12">
    <div class="card card-navy">
        <div class="card-header">
            <h5 class="card-title">Gestionar Programas</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="programas" value="true" class="custom-control-input" type="checkbox" id="programas"
                           @if (leerJson($user->permisos, 'programas')) checked @endif>
                    <label for="programas" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="ferias_campo" value="true" class="custom-control-input" type="checkbox" id="ferias_campo"
                       @if (leerJson($user->permisos, 'ferias.index')) checked @endif>
                <label for="ferias_campo" class="custom-control-label">Ferias Campo Soberano</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="tienda_movil" value="true" class="custom-control-input" type="checkbox" id="tienda_movil"
                       @if (leerJson($user->permisos, 'movil.index')) checked @endif>
                <label for="tienda_movil" class="custom-control-label">Tienda Movil</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="tienda_fisica" value="true" class="custom-control-input" type="checkbox" id="tienda_fisica"
                       @if (leerJson($user->permisos, 'fisica.index')) checked @endif>
                <label for="tienda_fisica" class="custom-control-label">Tiendas Fisicas</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="tienda_enlinea" value="true" class="custom-control-input" type="checkbox" id="tienda_enlinea"
                       @if (leerJson($user->permisos, 'enlinea.index')) checked @endif>
                <label for="tienda_enlinea" class="custom-control-label">Tiendas En Linea</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="plan_proteico" value="true" class="custom-control-input" type="checkbox" id="plan_proteico"
                       @if (leerJson($user->permisos, 'proteico.index')) checked @endif>
                <label for="plan_proteico" class="custom-control-label">Plan Proteico</label>
            </div>
        </div>
    </div>
</div>
