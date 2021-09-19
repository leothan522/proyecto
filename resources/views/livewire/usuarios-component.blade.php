<div>
    <div class="row justify-content-center">

        @if(leerJson(Auth::user()->permisos, 'usuarios.create') || Auth::user()->role == 100)
            @include('admin.usuarios_new.create')
        @endif

        <div class="col-md-9">

            <div class="card card-outline card-primary"
                 style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        @if(leerJson(Auth::user()->permisos, 'usuarios.excel') || Auth::user()->role == 100)
                            <a href="{{ route('usuarios.excel') }}"
                               class="btn btn-tool text-success swalDefaultInfo" {{--target="_blank"--}}>
                                <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                            </a>
                        @else
                            <a href="{{ route('usuarios.excel') }}"
                               class="btn btn-tool text-success swalDefaultInfo disabled" {{--target="_blank"--}}>
                                <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                            </a>
                        @endif
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                    @include('admin.usuarios_new.table')

                    @include('admin.usuarios_new.modal_edit')

                    @include('admin.usuarios_new.modal_permisos')


                </div>
                <!-- /.card-body -->
            </div>

            <div class="row justify-content-end p-3">
                <div class="col-md-3">
                    <span>
                    {{ $users->render() }}
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
