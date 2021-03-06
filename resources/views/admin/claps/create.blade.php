@extends('layouts.admin.master')

@section('title', 'CLAPS')

@section('header', 'CLAPS')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('claps.index') }}">CLAPS Registrados</a></li>
    <li class="breadcrumb-item active">Crear Nuevo</li>
@endsection

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script>
        // bloques
        var bloques_nombres = [];
        var bloques_id = [];
        @foreach($json_bloques_valor as $valor)
        bloques_nombres.push(@json($valor))
        @endforeach
        @foreach($json_bloques_id as $valor)
        bloques_id.push(@json($valor))
        @endforeach

        //parroquias
        var parroquias_nombres = [];
        var parroquias_id = [];
        @foreach($json_parroquias_valor as $valor)
        parroquias_nombres.push(@json($valor))
        @endforeach
        @foreach($json_parroquias_id as $valor)
        parroquias_id.push(@json($valor))
        @endforeach
    </script>
@endsection

@section('script')
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $('[data-mask]').inputmask();

        function select_bloques(){
            //tomo el valor del select elegido
            var municipios_id;
            municipios_id = document.f1.municipios_id[document.f1.municipios_id.selectedIndex].value;
            //miro a ver si el select está definido
            if (municipios_id != 0) {
                //si estaba definido, entonces coloco las opciones correspondientes.
                //selecciono el array adecuado
                mis_bloques=bloques_nombres[municipios_id];
                mis_id=bloques_id[municipios_id];
                //calculo el numero del array
                num_bloques = mis_bloques.length;
                //marco el número de elementos en el select
                document.f1.bloques_id.length = num_bloques;
                //para cada elemento del array, la introduzco en el select
                for(i=0;i<num_bloques;i++){
                    document.f1.bloques_id.options[i].value=mis_id[i];
                    document.f1.bloques_id.options[i].text=mis_bloques[i];
                }
            }else{
                //si no había bloques_id seleccionada, elimino las bloques_ids del select
                document.f1.bloques_id.length = 1;
                //coloco un guión en la única opción que he dejado
                document.f1.bloques_id.options[0].value = "-";
                document.f1.bloques_id.options[0].text = "-";
            }
            //marco como seleccionada la opción primera de bloques_id
            document.f1.bloques_id.options[0].selected = true;
        }

        function select_parroquias(){
            //tomo el valor del select elegido
            var municipios_id;
            municipios_id = document.f1.municipios_id[document.f1.municipios_id.selectedIndex].value;
            //miro a ver si el select está definido
            if (municipios_id != 0) {
                //Inicio el select en el blanco
                document.f1.parroquias_id.length = 1;
                document.f1.parroquias_id.options[0].value = "-";
                document.f1.parroquias_id.options[0].text = "-";
                //si estaba definido, entonces coloco las opciones correspondientes.
                //selecciono el array adecuado
                mis_parroquias=parroquias_nombres[municipios_id];
                mis_id=parroquias_id[municipios_id];
                //calculo el numero del array
                num_parroquias = mis_parroquias.length;
                //marco el número de elementos en el select
                document.f1.parroquias_id.length = num_parroquias;
                //para cada elemento del array, la introduzco en el select
                for(i=0;i<num_parroquias;i++){
                    document.f1.parroquias_id.options[i].value=mis_id[i];
                    document.f1.parroquias_id.options[i].text=mis_parroquias[i];
                }
            }else{
                //si no había bloques_id seleccionada, elimino las bloques_ids del select
                document.f1.parroquias_id.length = 1;
                //coloco un guión en la única opción que he dejado
                document.f1.parroquias_id.options[0].value = "-";
                document.f1.parroquias_id.options[0].text = "-";
            }
            //marco como seleccionada la opción primera de bloques_id
            document.f1.parroquias_id.options[0].selected = true;
        }

       document.addEventListener('DOMContentLoaded', function () {
            var detalles_import = document.getElementById('detalles_import');
            var boton_cerrar = document.getElementById('boton_cerrar');
            boton_cerrar.addEventListener('click', function () {
                detalles_import.classList.add('d-none');
            });
       });

    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="col-md-12 text-center">
                    @include('flash::message')
                </div>
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {!! Form::open(['route' => 'claps.store', 'method' => 'post', 'name' => 'f1']) !!}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Datos del CLAP</h3>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-clone"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Programa</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                        </div>
                                        {!! Form::select('programa', programa() , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Municipio</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        {!! Form::select('municipios_id', $municipios , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'onchange'=> 'select_parroquias(); select_bloques()', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Parroquia</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                        </div>
                                        {!! Form::select('parroquias_id', $parroquias , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Bloque</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                        </div>
                                        {!! Form::select('bloques_id', $bloques , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Nombre del CLAP</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                        </div>
                                        {!! Form::text('nombre_clap', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre del CLAP', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Comunidad</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        {!! Form::text('comunidad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Comunidad', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Codigo SICA</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                                        </div>
                                        {!! Form::text('codigo_sica', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Codigo SICA', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Codigo SPDA</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                                        </div>
                                        {!! Form::text('codigo_spda', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Codigo SPDA']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- Default box -->
                <div class="card card-navy collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Geolocalización</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-globe-americas"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Longitud</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                        </div>
                                        {!! Form::text('longitud', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Longitud']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Latitud</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                        </div>
                                        {!! Form::text('latitud', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Latitud']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Google Maps</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                        </div>
                                        {!! Form::text('google_maps', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Google Maps']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Dirección</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Dirección']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card card-navy collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Datos del Responsable</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-user"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Nacionalidad</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                        </div>
                                        {!! Form::select('nacionalidad_lider', ['VENEZOLANA' => 'VENEZOLANA', 'EXTRANJERA' => 'EXTRANJERA'] , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Cedula</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        {!! Form::text('cedula_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Cedula']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Primer Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        {!! Form::text('primer_nombre_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Segundo Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        {!! Form::text('segundo_nombre_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Primer Apellido</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        {!! Form::text('primer_apellido_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Apellido']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Segundo Apellido</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        {!! Form::text('segundo_apellido_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Apellido']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">N° Telefono 1</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        {!! Form::text('telefono_1_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Telefono', 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="name">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        {!! Form::email('email_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Correo']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Estatus</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                                        </div>
                                        {!! Form::select('estatus_lider', ['ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO'] , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Genero</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-male"></i></span>
                                        </div>
                                        {!! Form::select('genero', ['MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'] , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Fecha de Nacimiento</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="fecha_nac_lider" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Profesión</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                        </div>
                                        {!! Form::text('profesion_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Profesión']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Trabajo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        </div>
                                        {!! Form::select('trabajo_lider', ['SI' => 'SI', 'NO' => 'NO'] , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">N° Telefono 2</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        {!! Form::text('telefono_2_lider', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Telefono','data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 text-right">
                <input type="hidden" name="observaciones" value="{{ Auth::user()->name }}">
                <button type="reset" class="btn btn-default"><i class="fas fa-trash"></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 text-right p-3">
                <a href="javascript:history.back()"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>
@endsection
