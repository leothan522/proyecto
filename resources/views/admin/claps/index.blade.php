@extends('layouts.admin.master')

@section('title', 'Consultar CLAPS')

@section('header', 'Consultar CLAPS')

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

        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
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

        document.addEventListener('DOMContentLoaded', function () {
            var resultado_busqueda = document.getElementById('resultado_busqueda');
            var estadisticas = document.getElementById('estadisticas');
            var boton_cerrar = document.getElementById('boton_cerrar');
            boton_cerrar.addEventListener('click', function () {
                resultado_busqueda.classList.add('d-none');
                estadisticas.classList.add('d-none');
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
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="col-md-12" id="estadisticas">
                        <div class="card-body">

                            <p class="text-center">
                                <strong>Datos Cargados</strong>
                            </p>

                            <div class="progress-group">
                                N° CLAPS
                                <span class="float-right"><b>{{ formatoMillares(0, 0) }}</b>/{{ formatoMillares(0, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: {{ obtenerPorcentaje(0, 0) }}%">{{ obtenerPorcentaje(0, 0) }}%</div>
                                </div>
                            </div>
                            {{--<div class="progress-group">
                                N° CLAPS
                                <span class="float-right"><b>{{ formatoMillares(0, 0) }}</b>/{{ formatoMillares(0, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: {{ obtenerPorcentaje(0, 0) }}%">{{ obtenerPorcentaje(0, 0) }}%</div>
                                </div>
                            </div>--}}
                            <!-- /.progress-group -->
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
                                <label for="name">Codigo SPDA</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-code"></i></span>
                                    </div>
                                    {!! Form::text('codigo_spda', $codigo_spda, ['class' => 'form-control', 'placeholder' => 'Ingrese Codigo']) !!}
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
                        <div class="float-right">
                            <input type="hidden" name="buscar" value="true">
                            <button class="btn btn-sm bg-navy"><i class="fas fa-search"></i> Buscar</button>
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
                        <h5 class="card-title">Resultados de la Busqueda</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" id="boton_cerrar"><i class="fas fa-times"></i></button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Codigo SPDA</th>
                                    <th scope="col" class="text-center">Nombre CLAPS</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Municipio</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Parroquia</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Bloque</th>
                                    <th scope="col" data-breakpoints="xs" class="text-center">Cedula Lider</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ver_resultados as $clap)
                                    <tr>
                                        <td class="text-center">{{ $clap->id }}</td>
                                        <td class="text-center text-bold">{{ strtoupper($clap->codigo_spda) }}</td>
                                        <td class="text-center">{{ strtoupper($clap->nombre_clap) }}</td>
                                        <td class="text-center">{{ $clap->municipios->nombre_corto }}</td>
                                        <td class="text-center">{{ $clap->parroquias->nombre_completo }}</td>
                                        <td class="text-center">{{ strtoupper($clap->parametros->valor) }}</td>
                                        <td class="text-center">@if ($clap->nacionalidad_lider == "VENEZOLANA")V @endif{{ formatoMillares($clap->cedula_lider, 0) }}</td>
                                        <td class="">

                                            {!! Form::open(['route' => ['bloques.destroy', $clap->id], 'method' => 'DELETE']) !!}
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                @if (leerJson(Auth::user()->permisos, 'bloques.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $clap->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'bloques.destroy') || Auth::user()->role == 100)
                                                    <input type="hidden" name="consultar" value="{{ true }}">
                                                    <button type="submit" class="btn btn-info"><i class="fas fa-trash"></i></button>
                                                @endif
                                            </div>
                                            {!! Form::close() !!}



                                            {{--<!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $clap->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['bloques.update', $clap->id], 'method' => 'PUT']) !!}

                                                            <div class="form-group">
                                                                <label for="name">Nombre Bloque</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                    </div>
                                                                    <input type="hidden" name="tabla_id" value="{{ $clap->id }}">
                                                                    {!! Form::text('nombre_bloque', $clap->valor, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">N° CLAPS</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                    </div>
                                                                    <input type="hidden" name="id_clap" value="{{ $clap->id_clap }}">
                                                                    <input type="hidden" name="nombre_clap" value="bloque_claps">
                                                                    {!! Form::number('valor_clap', $clap->claps, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">N° Familias</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                                    </div>
                                                                    <input type="hidden" name="id_familias" value="{{ $clap->id_familia }}">
                                                                    <input type="hidden" name="nombre_familias" value="bloque_familias">
                                                                    {!! Form::number('valor_familias', $clap->familias, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                                                            </div>

                                                            {!! Form::close() !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Modal -->--}}



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
