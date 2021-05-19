@extends('layouts.admin.master')

@section('title', 'Plan Proteico')

@section('header', 'Plan Proteico')

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
                @if (leerJson(Auth::user()->permisos, 'proteico.store') || Auth::user()->role == 100)
                    <div class="card card-navy">
                        <div class="card-header">
                            <h5 class="card-title">Ingresar Reporte</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'proteico.store', 'method' => 'post', 'name' => 'f1']) !!}

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
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    {!! Form::select('parroquias_id', ['' => 'Seleccione'], null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Procedencia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    </div>
                                    {!! Form::select('parametros_id', $select_procedencias, null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Rubros</label>
                                <div class="input-group mb-3">

                                    @foreach($rubros as $rubro)
                                        @php($i++)
                                        <div class="custom-control custom-checkbox col-md-12">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $i }}"  name="rubro{{ $i }}" value="{{ $rubro->valor }}">
                                            <label for="customCheckbox{{ $i }}" class="custom-control-label">{{ $rubro->valor }}</label>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="cont" value="{{ $i }}">

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
                        <h5 class="card-title">Reportes Realizadas</h5>
                        <div class="card-tools">
                            @if (leerJson(Auth::user()->permisos, 'proteico.show') || Auth::user()->role == 100)
                                <a href="{{ route('proteico.index') }}" class="btn btn-tool">Volver{{--<i class="fas fa-calendar-alt"></i>--}}</a>
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
                                    <th scope="col" class="text-center">Procedencias</th>
                                    <th scope="col" class="text-center">Rubros</th>
                                    <th scope="col" class="text-center">Fecha</th>
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
                                        <td>{{ $feria->parametros->valor }}</td>
                                        <td>
                                            @if($feria->rubros)
                                            @php($products = json_decode($feria->rubros, true))
                                            <ul class="text-sm">
                                            @foreach($products as $clave => $valor)
                                                <li><small>{{ $clave }}</small></li>
                                            @endforeach
                                            </ul>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ fecha($feria->fecha)  }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['proteico.destroy', $feria->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$feria->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'proteico.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $feria->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'proteico.destroy') || Auth::user()->role == 100)
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

                                                            {!! Form::open(['route' => ['proteico.update', $feria->id], 'method' => 'PUT']) !!}

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
                                                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                                    </div>
                                                                    <label class="form-control">{{ $feria->parroquias->nombre_completo }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Procedencia</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                    </div>
                                                                    {!! Form::select('parametros_id', $select_procedencias, $feria->parametros_id, ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Rubros</label>
                                                                <div class="input-group mb-3">

                                                                    @foreach($rubros as $rubro)
                                                                        @php($i++)
                                                                        <div class="custom-control custom-checkbox col-md-12">
                                                                            <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $i }}" name="rubro{{ $i }}" value="{{ $rubro->valor }}"
                                                                                   @if(leerJson($feria->rubros, $rubro->valor))
                                                                                   checked
                                                                                @endif
                                                                            >
                                                                            <label for="customCheckbox{{ $i }}" class="custom-control-label">{{ $rubro->valor }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                    <input type="hidden" name="cont" value="{{ $i }}">

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
