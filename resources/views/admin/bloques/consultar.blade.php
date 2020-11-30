@extends('layouts.admin.master')

@section('title', 'Consultar Bloques')

@section('header', 'Consultar Bloques')

@section('breadcrumb')
    <li class="breadcrumb-item active">Bloques Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script>
        var bloques_nombres = [];
        var bloques_id = [];
        @foreach($json_bloque_valor as $valor)
            bloques_nombres.push(@json($valor))
        @endforeach
        @foreach($json_bloque_id as $valor)
        bloques_id.push(@json($valor))
        @endforeach
    </script>
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
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

        document.addEventListener('DOMContentLoaded', function () {
            var resultado_busqueda = document.getElementById('resultado_busqueda');
            var boton_cerrar = document.getElementById('boton_cerrar');
            boton_cerrar.addEventListener('click', function () {
                resultado_busqueda.classList.add('d-none');
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cubes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">N° Total Bloques</span>
                            <span class="info-box-number">
                                {{ cerosIzquierda(formatoMillares($total, 0)) }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-6">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Criterio de Búsqueda</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                    {!! Form::open(['route' => ['bloques.consultar'], 'method' => 'GET', 'name' => 'f1']) !!}
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Municipio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                {!! Form::select('municipios_id', $municipios, $id_municipio, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required', 'onchange'=> 'select_bloques()']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Bloque</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                </div>
                                {!! Form::select('bloques_id', $mun_bloques, $id_bloque, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione']) !!}
                            </div>
                        </div>
                        </div>
                        <div class="float-right">
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
        @if ($ver_municipio)
            <div class="row justify-content-center" id="resultado_busqueda">
                <div class="col-md-2">
                    <div class="card-body">


                    <p class="text-center">
                        <strong>Parametros Municipio</strong>
                    </p>

                    <div class="progress-group">
                        N° CLAPS
                        <span class="float-right"><b>{{ formatoMillares($total_claps, 0) }}</b>/{{ formatoMillares($mun_claps, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ obtenerPorcentaje($total_claps, $mun_claps) }}%">{{ obtenerPorcentaje($total_claps, $mun_claps) }}%</div>
                        </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                        N° Familias
                        <span class="float-right"><b>{{ formatoMillares($total_familias, 0) }}</b>/{{ formatoMillares($mun_familias, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width: {{ obtenerPorcentaje($total_familias, $mun_familias) }}%">{{ obtenerPorcentaje($total_familias, $mun_familias) }}%</div>
                        </div>
                    </div>
                    <br><div class="dropdown-divider"></div>
                    <p class="text-center">
                        <strong>Datos Cargados</strong>
                    </p>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <span class="progress-text">N° CLAPS</span>
                        <span class="float-right"><b>480</b>/{{ formatoMillares($total_claps, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: 60%">60%</div>
                        </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        N° Familias
                        <span class="float-right"><b>250</b>/{{ formatoMillares($total_familias, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: 50%">50%</div>
                        </div>
                    </div>
                    <!-- /.progress-group -->
                    </div>
                </div>

                <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">{{ $ver_municipio->nombre_completo }}</h5>
                        <div class="card-tools">
                            {!! Form::open(['route' => 'bloques.store', 'method' => 'POST']) !!}
                            @if (leerJson(Auth::user()->permisos, 'bloques.store') || Auth::user()->role == 100)

                                <input type="hidden" name="nombre" value="bloques">
                                <input type="hidden" name="tabla_id" value="{{ $ver_municipio->id }}">
                                <input type="hidden" name="valor" value="{{ $ver_bloques->count() + 1  }}">
                                @if ($ver_bloques->count() < 4)
                                    @if (leerJson(Auth::user()->permisos, 'bloques.store') || Auth::user()->role == 100)
                                        <button type="submit" class="btn btn-tool text-success"><i class="fas fa-plus-circle"></i> Crear Bloque</button>
                                    @endif
                                @endif
                            @endif
                            <button type="button" class="btn btn-tool" id="boton_cerrar"><i class="fas fa-times"></i></button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="card-body">


                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Bloques</th>
                                <th scope="col" data-breakpoints="xs" class="text-center">N° CLAPS</th>
                                <th scope="col" data-breakpoints="xs" class="text-center">N° Familias</th>
                                <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($ver_bloques as $bloque)
                                <tr>
                                    <td class="text-center">{{ strtoupper($bloque->valor) }}</td>
                                    <td class="text-center text-bold">{{ cerosIzquierda(formatoMillares($bloque->claps, 0)) }}</td>
                                    <td class="text-center text-bold">{{ cerosIzquierda(formatoMillares($bloque->familias, 0)) }}</td>
                                    <td class="">

                                        {!! Form::open(['route' => ['bloques.destroy', $bloque->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            @if (leerJson(Auth::user()->permisos, 'bloques.update') || Auth::user()->role == 100)
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $bloque->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'bloques.destroy') || Auth::user()->role == 100)
                                                <input type="hidden" name="consultar" value="{{ true }}">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </div>
                                        {!! Form::close() !!}



                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $bloque->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        {!! Form::open(['route' => ['bloques.update', $bloque->id], 'method' => 'PUT']) !!}

                                                        <div class="form-group">
                                                            <label for="name">Nombre Bloque</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                </div>
                                                                {{--<input type="hidden" name="tabla_id" value="{{ $bloque->id }}">--}}
                                                                {!! Form::text('nombre_bloque', $bloque->valor, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">N° CLAPS</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                </div>
                                                                <input type="hidden" name="id_clap" value="{{ $bloque->id_clap }}">
                                                                <input type="hidden" name="nombre_clap" value="bloque_claps">
                                                                {!! Form::number('valor_clap', $bloque->claps, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">N° Familias</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                                </div>
                                                                <input type="hidden" name="id_familias" value="{{ $bloque->id_familia }}">
                                                                <input type="hidden" name="nombre_familias" value="bloque_familias">
                                                                {!! Form::number('valor_familias', $bloque->familias, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
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
        @endif
    </div>


@endsection
