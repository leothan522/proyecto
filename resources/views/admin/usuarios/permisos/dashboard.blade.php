<div class="col-md-3">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title">Admin Dashboard</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="admin_dashboard" value="true" class="custom-control-input" type="checkbox" id="tituloDashboard"
                           @if (leerJson($user->permisos, 'admin.dashboard')) checked @endif>
                    <label for="tituloDashboard" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            /

        </div>
    </div>
</div>
