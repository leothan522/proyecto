@extends('layouts.admin.master')

@section('title', 'CLAPS')

@section('header', 'CLAPS')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('claps.formato') }}"><i class="fas fa-download"></i> Formato Excel</a></li>
    <li class="breadcrumb-item active">Lideres de Calle</li>
    <li class="breadcrumb-item"><a href="{{ route('claps.censo', $clap->id) }}">Censo</a></li>
@endsection

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/importar_claps.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        /*document.addEventListener('DOMContentLoaded', function () {
            var btn_exportar = document.getElementById('btn_exportar');
            var url = btn_exportar.getAttribute('href');
            btn_exportar.addEventListener('click', function (e) {
                e.preventDefault();
                alertExport(url);
            });
        });*/

        function cambiar(){
            var pdrs = document.getElementById('customFileLang').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
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
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            CLAP: <span class="text-bold">{{ $clap->nombre_clap }}</span>
                        </h3>

                        <div class="card-tools">
                            <span class="btn btn-tool text-bold text-danger">Estructura CLAP</span>
                            {{--<a href="#" id="btn_exportar" class="btn btn-tool text-success"><i class="fas fa-file-excel"></i> Generar Excel</a>
                            --}}{{--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>--}}
                            {{--<span class="float-right text-muted text-xs">
                                {{ fecha($parametro->created_at, 'd-m-Y h:i a') }} /
                                <i class="fa fa-user"></i> {{ $parametro->usuarios->name }}</span>--}}
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover bg-light table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Rol</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" style="width: 5%;">&emsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($estructura as $lider)
                                <tr>
                                    <td>{{ $lider->estructura_clap }}</td>
                                    <td>{{ $lider->nombre_completo }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{--<a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $lider->id }}"><i class="fas fa-eye"></i></a>
                                            --}}<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-estructura-{{ $lider->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>



                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-estructura-{{ $lider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Titulo Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        hola
                                                        <div class="row justify-content-end mt-3">
                                                            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            CLAP: <span class="text-bold">{{ $clap->nombre_clap }}</span>
                        </h3>

                        <div class="card-tools">
                            <span class="btn btn-tool text-bold text-danger">Lideres de calle</span>
                            <a href="#" id="btn_exportar" class="btn btn-tool text-success"><i class="fas fa-file-excel"></i> Generar Excel</a>
                            {{--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>--}}
                            {{--<span class="float-right text-muted text-xs">
                                {{ fecha($parametro->created_at, 'd-m-Y h:i a') }} /
                                <i class="fa fa-user"></i> {{ $parametro->usuarios->name }}</span>--}}
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover bg-light table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cedula</th>
                                <th scope="col" style="width: 5%;">&emsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($lideres as $lider)
                                @php($i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $lider->nombre_completo }}</td>
                                    <td>{{ $lider->tipo_ci }} {{ $lider->cedula }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{--<a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $lider->id }}"><i class="fas fa-eye"></i></a>--}}
                                            <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-lideres-{{ $lider->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-lideres-{{ $lider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Titulo Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        hola
                                                        <div class="row justify-content-end mt-3">
                                                            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Modal -->





                                    </td>
                                </tr>
                            @endforeach
                            {{--@foreach ($imports as $import)
                                <tr>
                                    {!! Form::open(['route' => ['claps.post_revision', $parametro->id], 'method' => 'post']) !!}

                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ strtoupper($import->nombre_clap) }}</td>
                                    <td class="col-md-3">
                                        {!! Form::select('municipios_id', $municipios , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </td>
                                    <td class="col-md-3">
                                        {!! Form::select('parroquias_id', $parroquias , null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </td>
                                    <td class="col-md-1">
                                        {!! Form::text('bloques_id', $import->bloques_id, ['class' => 'form-control', 'min' => 1, 'max' => 4]) !!}
                                    </td>
                                    <td class="col-md-1">
                                        <div class="btn-group">
                                            <input type="hidden" name="delete" value="{{ false }}">
                                            <input type="hidden" name="todo" value="{{ false }}">
                                            <input type="hidden" name="id_clap" value="{{ $import->id }}">
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $import->id }}"><i class="fas fa-eye"></i></a>
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </td>
                                    {!! Form::close() !!}
                                    <td class="">

                                        {!! Form::open(['route' => ['claps.post_revision', $parametro->id], 'method' => 'Post', 'id' => 'form_delete_'.$import->id]) !!}
                                        <div class="btn-group">
                                            <input type="hidden" name="delete" value="{{ true }}">
                                            <input type="hidden" name="todo" value="{{ false }}">
                                            <input type="hidden" name="id_clap" value="{{ $import->id }}">
                                            <button type="button" onclick="alertaBorrar('form_delete_{{ $import->id }}')" class="btn btn-info" --}}{{--id="show-alert-{{ $import->id }}"--}}{{--><i class="fas fa-trash"></i></button>
                                            --}}{{--<script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    var boton = document.getElementById('show-alert-{{ $import->id }}');
                                                    boton.addEventListener('click', function () {
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
                                                                    document.getElementById('form_delete_{{ $import->id }}').submit();
                                                                }
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>--}}{{--
                                        </div>
                                        {!! Form::close() !!}



                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $import->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $import->nombre_clap }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Programa</span>
                                                                <span class="text-sm"><i>{{ $import->programa }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Municipio</span>
                                                                <span class="text-sm  @if (leerJson($import->observaciones, 'municipio')) text-danger @endif">
                                                                    <i>@if (leerJson($import->observaciones, 'municipio')) * @endif{{ $import->municipios_id }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Parroquia</span>
                                                                <span class="text-sm @if (leerJson($import->observaciones, 'parroquia')) text-danger @endif">
                                                                    <i>@if (leerJson($import->observaciones, 'parroquia')) * @endif{{ $import->parroquias_id }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Comunidad</span>
                                                                <span class="text-sm"><i>{{ $import->comunidad }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Bloque</span>
                                                                <span class="text-sm @if (leerJson($import->observaciones, 'bloque')) text-danger @endif">
                                                                    <i>@if (leerJson($import->observaciones, 'bloque')) * @endif{{ $import->bloques_id }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-bold">Codigo SPDA</span>
                                                                <span class="text-sm"><i>@if ($import->codigo_spda == null) - @endif{{ $import->codigo_spda }}</i></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-center align-items-center">
                                                                <span class="text-bold">Lider CLAP</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-sm"><i>
                                                                {{ $import->primer_nombre_lider }}
                                                                {{ $import->segundo_nombre_lider }}
                                                                {{ $import->primer_apellido_lider }}
                                                                {{ $import->segundo_apellido_lider }}
                                                                </i></span>
                                                                <span class="text-sm"><i>
                                                                    {{ $import->cedula_lider }}
                                                                </i></span>
                                                            </li>

                                                        </ul>
                                                        <div class="row justify-content-end mt-3">
                                                            <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Modal -->



                                    </td>
                                </tr>
                            @endforeach--}}
                            </tbody>
                        </table>

                        {{--<div class="row col-md-12 justify-content-end mt-3">
                            {!! Form::open(['route' => ['claps.post_revision', $parametro->id], 'method' => 'Post', 'id' => 'form_delete_todo']) !!}
                            <div>
                                <input type="hidden" name="delete" value="{{ true }}">
                                <input type="hidden" name="todo" value="{{ true }}">
                                <input type="hidden" name="id_clap" value="{{ $import->id }}">
                                <a href="{{ route('claps.get_revision_export', $parametro->id) }}" id="btn_exportar"
                                   --}}{{--onclick="alertExport('{{ route('claps.get_revision_export', $parametro->id) }}')"--}}{{--
                                   class="btn btn-sm bg-navy"><i class="fas fa-file-excel"></i>
                                    Generar Excel
                                </a>
                                <button type="button" onclick="alertaBorrar('form_delete_todo')" class="btn btn-sm btn-danger" --}}{{--id="show-alert-todo2"--}}{{--><i class="fas fa-trash"></i> Borrar todo</button>
                                --}}{{--<script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var boton = document.getElementById('show-alert-todo2');
                                        boton.addEventListener('click', function () {
                                            bootbox.confirm({
                                                size: "small",
                                                message: "¿Eliminar Todo2?",
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
                                                        document.getElementById('form_delete_todo').submit();
                                                    }
                                                }
                                            });
                                        });
                                    });
                                </script>--}}{{--
                            </div>
                            {!! Form::close() !!}
                        </div>--}}

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Importar Data Excel</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-cloud-upload-alt"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => ['claps.censo_import', $clap->id], 'method' => 'post', 'files' => true, 'id' => 'form_importar']) !!}

                        <div class="form-group">
                            <label for="name">Subir Archivo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-excel"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="excel" class="custom-file-input" id="customFileLang" onchange='cambiar()' lang="es" accept=".xlsx,.xls" required>
                                    <label class="custom-file-label" for="customFileLang" data-browse="Elegir" id="info">Seleccionar Archivo</label>
                                </div>
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
                            <input type="submit" class="btn btn-block btn-primary" value="Importar">
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
                <div class="card-body">

                    <p class="text-center">
                        <strong>Datos Cargados</strong>
                    </p>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <span class="progress-text">N° Lideres de Calle</span>
                        <span class="float-right"><b>{{ formatoMillares($lideres->count(), 0) }}</b>/{{ formatoMillares($clap->num_lideres, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar {{ colorBarra(obtenerPorcentaje($lideres->count(), $clap->num_lideres)) }}"
                                 style="width: {{ obtenerPorcentaje($lideres->count(), $clap->num_lideres) }}%">
                                {{ obtenerPorcentaje($lideres->count(), $clap->num_lideres) }}%
                            </div>
                        </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <span class="progress-text">N° Familias</span>
                        <span class="float-right"><b>{{ formatoMillares($familias, 0) }}</b>/{{ formatoMillares($clap->num_familias, 0) }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar {{ colorBarra(obtenerPorcentaje($familias, $clap->num_familias)) }}"
                                 style="width: {{ obtenerPorcentaje($familias, $clap->num_familias) }}%">
                                {{ obtenerPorcentaje($familias, $clap->num_familias) }}%
                            </div>
                        </div>
                    </div>
                    <!-- /.progress-group -->
                </div>

                @if($lideres && $familias)
                <div class="row col-md-12 justify-content-center">
                    {!! Form::open(['route' => ['claps.censo_delete', $clap->id], 'method' => 'Post', 'id' => 'form_delete_todo']) !!}
                    <div class="">
                        <input type="hidden" name="delete" value="{{ true }}">
                        <input type="hidden" name="todo" value="{{ true }}">
                        <input type="hidden" name="id_clap" value="{{ $clap->id }}">
                        <button type="button" onclick="alertaBorrar('form_delete_todo')" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Borrar todo
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
                @endif

            </div>
        </div>
        <div class="row justify-content-end p-3">
            <div class="col-md-3">
                <span>
                {{--{{ $imports->render() }}--}}
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                {{--<a href="{{ route('claps.get_import', $parametro->id) }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>--}}
            </div>
        </div>
    </div>
@endsection
