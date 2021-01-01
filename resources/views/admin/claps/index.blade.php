@extends('layouts.admin.master')

@section('title', 'CLAPS')

@section('header', 'CLAPS')

@section('breadcrumb')
    <li class="breadcrumb-item active">CLAPS Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
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
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        jQuery(function ($) {
            $('.table').footable();
        });
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

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

        var btn_exportar_all = document.getElementById('all_btn');
        var url_all = btn_exportar_all.getAttribute('href');
        btn_exportar_all.addEventListener('click', function (e) {
            e.preventDefault();
            alertExport(url_all);
        });

        document.addEventListener('DOMContentLoaded', function () {
            var resultado_busqueda = document.getElementById('resultado_busqueda');
            var estadisticas = document.getElementById('estadisticas');
            var boton_cerrar = document.getElementById('boton_cerrar');
            boton_cerrar.addEventListener('click', function () {
                resultado_busqueda.classList.add('d-none');
                estadisticas.classList.add('d-none');
            });

            var btn_exportar = document.getElementById('btn_exportar');
            var url = btn_exportar.getAttribute('href');
            btn_exportar.addEventListener('click', function (e) {
                e.preventDefault();
                alertExport(url);
            });

        });

    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clone"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">N° Total CLAPS</span>
                            <span class="info-box-number">
                                {{ cerosIzquierda(formatoMillares($total_claps, 0)) }}
                                @if ($total_claps > 0)
                                    @if (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100)
                                    <span class="float-right">
                                        <a href="{{ route('claps.export') }}" id="all_btn" class="text-muted"><i class="fas fa-cloud-download-alt"></i></a>
                                    </span>
                                    @endif
                                @endif

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                        <div class="col-md-12">
                            <div class="card-body">

                                <p class="text-center">
                                    <strong>Datos Cargados</strong>
                                </p>

                                <div class="progress-group">
                                    <a href="{{ route('claps.show', 'datos-cargados') }}" class="text-muted">N° CLAPS</a>
                                    <span class="float-right @if($total_claps && !$claps_estadal) text-danger @endif">
                                        @if($total_claps && !$claps_estadal) <a href="{{ route('familias.index') }}" class="text-xs text-danger">(Error)</a> @endif
                                        <b>{{ formatoMillares($total_claps, 0) }}</b>/{{ formatoMillares($claps_estadal, 0) }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: {{ obtenerPorcentaje($total_claps, $claps_estadal) }}%">{{ obtenerPorcentaje($total_claps, $claps_estadal) }}%</div>
                                    </div>
                                </div>
                                @if ($id_municipio)
                                    <div id="estadisticas">
                                    <br><div class="dropdown-divider"></div>
                                    <p class="text-center">
                                        {{--<strong>Parametros Municipio</strong>--}}
                                    </p>
                                    <div class="progress-group">
                                        @if ($claps_mun != 0)
                                            <a href="{{ route('claps.export', ['municipios_id' => $id_municipio, 'parroquias_id' => null,
                                          'bloques_id' => null, 'nombre_clap' => null, 'codigo_sica' => null, 'cedula_lider' => null, 'buscar' => true, 'datos_cargados' => true]) }}"
                                               class="text-muted"><i class="fas fa-cloud-download-alt text-sm"></i> {{ $municipios[$id_municipio] }}</a>
                                        @else
                                            <span class="text-muted">{{ $municipios[$id_municipio] }}</span>
                                        @endif
                                    <span class="float-right @if($claps_mun != 0 && $claps_municipal == 0) text-danger @endif">
                                        @if($claps_mun != 0 && $claps_municipal == 0) <a href="{{ route('familias.index') }}" class="text-xs text-danger">(Error)</a> @endif
                                        <b>{{ formatoMillares($claps_mun, 0) }}</b>/{{ formatoMillares($claps_municipal, 0) }}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar {{ colorBarra(obtenerPorcentaje($claps_mun, $claps_municipal)) }}" style="width: {{ obtenerPorcentaje($claps_mun, $claps_municipal) }}%">{{ obtenerPorcentaje($claps_mun, $claps_municipal) }}%</div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    </div>
                                @endif
                            </div>
                        </div>

                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-8">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Criterio de Búsqueda</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                    {!! Form::open(['route' => ['claps.index'], 'method' => 'GET', 'name' => 'f1']) !!}
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">Municipio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    {!! Form::select('municipios_id', $municipios, $id_municipio, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'onchange'=> 'select_parroquias(); select_bloques()']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Parroquia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    </div>
                                    {!! Form::select('parroquias_id', $parroquias, $id_parroquia, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Bloque</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    </div>
                                    {!! Form::select('bloques_id', $bloques, $id_bloque, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Nombre del CLAP</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                    </div>
                                    {!! Form::text('nombre_clap', $nombre_clap, ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Codigo SICA</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                                    </div>
                                    {!! Form::text('codigo_sica', $codigo_sica, ['class' => 'form-control', 'placeholder' => 'Ingrese Codigo']) !!}
                                </div>
                            </div>
                           <div class="form-group col-md-4">
                                <label for="name">Cedula Lider</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    {!! Form::text('cedula_lider', $cedula_lider, ['class' => 'form-control', 'placeholder' => 'Ingrese Cedula']) !!}
                                </div>
                            </div>

                        </div>
                        <div class="card-tools">
                            @if (leerJson(Auth::user()->permisos, 'claps.create') || Auth::user()->role == 100)
                                <a href="{{ route('claps.create') }}"class="btn btn-sm btn-tool text-primary mt-1"><i class="fas fa-plus-circle"></i> Crear Nuevo</a>
                            @endif
                        <div class="float-right">
                            <input type="hidden" name="buscar" value="true">
                            <a href="{{ route('claps.index') }}"class="btn btn-sm btn-default"><i class="fas fa-trash"></i> Limpiar</a>
                            <button class="btn btn-sm bg-navy"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                        </div>

                    {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        @if ($resultado)
            <div class="row justify-content-center" id="resultado_busqueda">
                <div class="col-md-11">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Resultados de la Busqueda: <strong class="text-primary">{{ cerosIzquierda(formatoMillares($ver_resultados->count(), 0)) }}</strong></h5>
                        <div class="card-tools">
                            @if ($ver_resultados->count() > 0)
                                @if (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100)
                                <a href="{{ route('claps.export', ['municipios_id' => $id_municipio, 'parroquias_id' => $id_parroquia,
                            'bloques_id' => $id_bloque, 'nombre_clap' => $nombre_clap, 'codigo_sica' => $codigo_sica, 'cedula_lider' => $cedula_lider]) }}"
                                   id="btn_exportar"
                                   class="btn btn-tool text-success"><i class="fas fa-file-excel"></i> Generar Excel</a>
                                @endif
                                <button type="button" class="btn btn-tool" id="boton_cerrar"><i class="fas fa-times"></i></button>
                            @endif
                            {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Codigo SICA</th>
                                    <th scope="col" class="text-center">Nombre CLAPS</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Municipio</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Parroquia</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Bloque</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Cedula Lider</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ver_resultados as $clap)
                                    <tr>
                                        <td class="text-center">{{ $clap->id }}</td>
                                        <td class="text-center text-bold">{{ strtoupper($clap->codigo_sica) }}</td>
                                        <td class="text-center">{{ strtoupper($clap->nombre_clap) }}</td>
                                        <td class="text-center">{{ $clap->municipios->nombre_corto }}</td>
                                        <td class="text-center">{{ $clap->parroquias->nombre_completo }}</td>
                                        <td class="text-center">{{ strtoupper($clap->parametros->valor) }}</td>
                                        <td class="text-center">@if ($clap->nacionalidad_lider == "VENEZOLANA")V- @endif{{ formatoMillares($clap->cedula_lider, 0) }}</td>
                                        <td>

                                            {!! Form::open(['route' => ['claps.destroy', $clap->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$clap->id]) !!}
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $clap->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if (leerJson(Auth::user()->permisos, 'claps.edit') || Auth::user()->role == 100)
                                                    <a href="{{ route('claps.edit', $clap->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'claps.destroy') || Auth::user()->role == 100)
                                                    <input type="hidden" name="consultar" value="{{ true }}">
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $clap->id }}')" class="btn btn-info {{--show-alert-{{ $clap->id }}--}}"><i class="fas fa-trash"></i></button>
                                                    {{--<script>
                                                        $(document).on("click", ".show-alert-{{ $clap->id }}", function(e) {
                                                            bootbox.confirm({
                                                                size: "small",
                                                                message: "¿Esta seguro que desea Eliminar?",
                                                                buttons: {
                                                                    confirm: {
                                                                        label: 'Si',
                                                                        className: 'btn-success'
                                                                    },
                                                                    cancel: {
                                                                        label: 'No',
                                                                        className: 'btn-danger'
                                                                    }
                                                                },
                                                                callback: function(result){
                                                                    /* result is a boolean; true = OK, false = Cancel*/
                                                                    if (result){
                                                                        document.getElementById('form_delete_{{ $clap->id }}').submit();
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    </script>--}}

                                                @endif
                                            </div>
                                            {!! Form::close() !!}



                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $clap->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CLAP <span class="text-bold">{{ $clap->nombre_clap }}</span></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- Default box -->
                                                                    <div class="card card-navy">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Datos del CLAP</h3>
                                                                        </div>
                                                                        <div class="card-body fondo">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label for="name">Programa</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ $clap->programa }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Municipio</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ $clap->municipios->nombre_completo }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Parroquia</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ $clap->parroquias->nombre_completo }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label for="name">Bloque</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ $clap->parametros->valor }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label for="name">Codigo SPDA</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->codigo_spda) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Codigo SICA</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->codigo_sica) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="name">Comunidad</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->comunidad) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <label for="name">Nombre del CLAP</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->nombre_clap) }}</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                    </div>
                                                                    <!-- /.card -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- Default box -->
                                                                    <div class="card card-navy">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Datos del Responsable</h3>
                                                                        </div>
                                                                        <div class="card-body fondo">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Nacionalidad</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->nacionalidad_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Cedula</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->cedula_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="name">Nombre del Responsable</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">
                                                                                            {{ strtoupper($clap->primer_nombre_lider) }}
                                                                                            {{ strtoupper($clap->segundo_nombre_lider) }}
                                                                                            {{ strtoupper($clap->primer_apellido_lider) }}
                                                                                            {{ strtoupper($clap->segundo_apellido_lider) }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">N° DE TELEFONO 1</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->telefono_1_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">N° DE TELEFONO 2</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->telefono_2_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="name">Email</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtolower($clap->email_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label for="name">Estatus</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->estatus_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Genero</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-male"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->genero) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Fecha de Nacimiento</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ fecha($clap->fecha_nac_lider, 'd-m-Y') }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Profesión</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->profesion_lider) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="name">Trabajo</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->trabajo_lider) }}</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                    </div>
                                                                    <!-- /.card -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- Default box -->
                                                                    <div class="card card-navy">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Geolocalización</h3>
                                                                        </div>
                                                                        <div class="card-body fondo">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <label for="name">Longitud</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->longitud) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="name">Latitud</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->latitud) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="name">Google Maps</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->google_maps) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="name">Dirección</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                                                                        </div>
                                                                                        <span class="form-control">{{ strtoupper($clap->direccion) }}</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                    </div>
                                                                    <!-- /.card -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Modal -->



                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>


@endsection
