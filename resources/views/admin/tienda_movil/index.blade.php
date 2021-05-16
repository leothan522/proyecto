@extends('layouts.admin.master')

@section('title', 'Tienda Movil')

@section('header', 'Tienda Movil')

@section('breadcrumb')
    <li class="breadcrumb-item active">Parametros Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script>

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

        function select_parroquias(){
            //tomo el valor del select elegido
            var municipios_id;
            municipios_id = document.f1.municipios_id[document.f1.municipios_id.selectedIndex].value;
            //miro a ver si el select está definido
            if (municipios_id != 0) {
                //Inicio el select en el blanco
                document.f1.parroquias_id.length = 1;
                document.f1.parroquias_id.options[0].value = "";
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
                document.f1.parroquias_id.options[0].value = "";
                document.f1.parroquias_id.options[0].text = "-";
            }
            //marco como seleccionada la opción primera de bloques_id
            document.f1.parroquias_id.options[0].selected = true;
        }


    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
                <div class="col-md-3">
                    {{--@if ($estadal)
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clone"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">N° Claps Estadal</span>
                                    <span class="info-box-number">
                                        {{ formatoMillares($claps->valor, 0) }}
                                        <span class="text-sm float-right">
                                            @if (leerJson(Auth::user()->permisos, 'familias.update') || Auth::user()->role == 100)
                                            <button type="submit" class="btn btn-xs text-primary" data-toggle="modal" data-target="#modal-{{ $estadal->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- /.info-box -->
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">N° Familias Estadal</span>
                                    <span class="info-box-number">
                                    {{ formatoMillares($estadal->valor, 0) }}
                                    <span class="text-sm float-right">
                                        @if (leerJson(Auth::user()->permisos, 'familias.update') || Auth::user()->role == 100)
                                            <button type="submit" class="btn btn-xs text-primary" data-toggle="modal" data-target="#modal-{{ $estadal->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @endif
                                    </span>
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        <!-- Modal -->
                            <div class="modal fade" id="modal-{{ $estadal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            {!! Form::open(['route' => ['familias.update', $estadal->id], 'method' => 'PUT']) !!}

                                            <div class="form-group">
                                                <label for="name">N° Clap Estadal</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                    </div>
                                                    {!! Form::number('valor_clap2', $claps->valor, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                    <input type="hidden" name="id_clap" value="{{ $claps->id }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">N° Familias Estadal</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                    </div>
                                                    {!! Form::number('valor2', $estadal->valor, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                    <input type="hidden" name="tabla_id2" value="{{ $estadal->tabla_id }}">
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
                        </div>
                    @endif--}}
                    @if (leerJson(Auth::user()->permisos, 'movil.store') || Auth::user()->role == 100)
                    <div class="card card-navy">
                        <div class="card-header">
                            <h5 class="card-title">Ingresar Fecha de Atención</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'movil.store', 'method' => 'post', 'name' => 'f1']) !!}

                            <div class="form-group">
                                <label for="name">Municipio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    {!! Form::select('municipios_id', $municipios, null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required', 'onchange'=> 'select_parroquias();']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Parroquia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    </div>
                                    {!! Form::select('parroquias_id', ['' => 'Seleccione'], null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    {!! Form::date('fecha', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">N° Familias</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    </div>
                                    {!! Form::number('familias', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">TM</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                    </div>
                                    {!! Form::number('tm', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 0.01, 'pattern' => "^[0-9]+", 'step' => 'any', 'required']) !!}
                                </div>
                            </div>
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

                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-block btn-success" value="Guardar">
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                    @endif
                </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Operativos Realizados</h5>
                        <div class="card-tools">
                            @if (leerJson(Auth::user()->permisos, 'movil.show') || Auth::user()->role == 100)
                            <div class="btn-group show">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="true">
                                    <i class="fas fa-filter"></i> Filtrar Municipio </button>
                                <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-52px, 31px, 0px);">
                                    @foreach($filtrar as $municipio)
                                        <a href="{{ route('movil.show', $municipio->id) }}" class="dropdown-item">{{ $municipio->nombre_completo }}</a>
                                    @endforeach
                                        <div class="dropdown-divider"></div>
                                    <a href="{{ route('movil.index') }}" class="dropdown-item">Ver Todo</a>
                                </div>
                            </div>
                            <span class="btn btn-tool"><i class="fas fa-calendar-alt"></i></span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                    <th scope="col">Municipios</th>
                                    <th scope="col">Parroquias</th>
                                    <th scope="col" class="text-center">Familias</th>
                                    <th scope="col" class="text-center">TM</th>
                                    <th scope="col" class="text-center">Fecha</th>
									<th scope="col" class="text-center">Nº de Días</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ferias as $feria)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $i++ }}</th>
                                        <td>{{ $feria->municipios->nombre_corto }}</td>
                                        <td>{{ $feria->parroquias->nombre_completo }}</td>
                                        <td class="text-center">{{ formatoMillares($feria->familias, 0) }}</td>
                                        <td class="text-right">{{ formatoMillares($feria->tm) }}</td>
                                        <td class="text-center">{{ fecha($feria->fecha)  }}</td>
										<td class="text-center">{{ cuantosDias($feria->fecha, date('Y-m-d'))  }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['movil.destroy', $feria->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$feria->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'movil.edit') || Auth::user()->role == 100)
                                                    <a href="{{ route('movil.edit', $feria->parroquias_id) }}" class="btn btn-info"><i class="fas fa-list"></i></a>
                                                @endif
												@if (leerJson(Auth::user()->permisos, 'movil.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $feria->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'movil.destroy') || Auth::user()->role == 100)
                                                    <input type="hidden" name="id_clap" value="{{ $feria->id_clap }}">
                                                    <button type="button" onclick="alertaBorrar('form_delete_{{ $feria->id }}')" class="btn btn-info show-alert-{{ $feria->id }}"><i class="fas fa-trash"></i></button>
                                                @endif
                                            </div>
                                            {!! Form::close() !!}

                                        <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $feria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['movil.update', $feria->id], 'method' => 'PUT']) !!}

                                                            <div class="form-group">
                                                                <label for="name">Municipio</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    <label class="form-control">{{ $feria->municipios->nombre_corto }}</label>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Parroquia</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                    </div>
                                                                    <label class="form-control">{{ $feria->parroquias->nombre_completo }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    {!! Form::date('fecha', $feria->fecha, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">N° Familias</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    </div>
                                    {!! Form::number('familias', $feria->familias, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">TM</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                    </div>
                                    {!! Form::number('tm', $feria->tm, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 0.01, 'pattern' => "^[0-9]+", 'step' => 'any', 'required']) !!}
                                </div>
                            </div>
                                                            <div class="form-group text-right">
                                                                <input type="submit" class="btn btn-block btn-primary" value="Guardar">
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

                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $ferias->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
