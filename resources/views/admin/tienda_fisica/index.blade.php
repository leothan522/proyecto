@extends('layouts.admin.master')

@section('title', 'Tiendas Fisicas')

@section('header', 'Tiendas Fisicas')

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

                    @if (leerJson(Auth::user()->permisos, 'fisica.store') || Auth::user()->role == 100)
                    <div class="card card-navy">
                        <div class="card-header">
                            <h5 class="card-title">Ingresar Reporte</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'fisica.store', 'method' => 'post', 'name' => 'f1']) !!}

                            <div class="form-group">
                                <label for="name">Tienda Fisica</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-store-alt"></i></span>
                                    </div>
                                    {!! Form::select('parametros_id', $select_tiendas, null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
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
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Reportes Registrados</h5>
                        <div class="card-tools">
                            @if (leerJson(Auth::user()->permisos, 'fisica.show') || Auth::user()->role == 100)
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
                                    <th scope="col">Tiendas Fisicas</th>
                                    <th scope="col" class="text-center">Familias</th>
                                    <th scope="col" class="text-center">TM</th>
                                    <th scope="col" class="text-center">Fecha</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ferias as $feria)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $i++ }}</th>
                                        <td>{{ $feria->parametros->municipios->nombre_corto }}</td>
                                        <td class="text-center">{{ formatoMillares($feria->familias, 0) }}</td>
                                        <td class="text-right">{{ formatoMillares($feria->tm) }}</td>
                                        <td class="text-center">{{ fecha($feria->fecha)  }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['fisica.destroy', $feria->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$feria->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'fisica.edit') || Auth::user()->role == 100)
                                                    <a href="{{ route('fisica.edit', $feria->parametros->id) }}" class="btn btn-info"><i class="fas fa-list"></i></a>
                                                @endif
												@if (leerJson(Auth::user()->permisos, 'fisica.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $feria->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'fisica.destroy') || Auth::user()->role == 100)
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Reporte</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['fisica.update', $feria->id], 'method' => 'PUT']) !!}

                                                            <div class="form-group">
                                                                <label for="name">Tienda Fisica</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-store-alt"></i></span>
                                                                    </div>
                                                                    <label class="form-control">{{ $feria->parametros->valor }}</label>
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

            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Tiendas Fisicas</h5>
                        <div class="card-tools">
                            @if (leerJson(Auth::user()->permisos, 'fisica.show') || Auth::user()->role == 100)
                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tiendas-create">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-tiendas-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Agregar Tienda Fisica</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                {!! Form::open(['route' => 'fisica.store', 'method' => 'POST']) !!}

                                                <div class="form-group">
                                                    <label for="name">Municipio</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                        </div>
                                                        {!! Form::select('tabla_id', $municipios, null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Condición Tienda</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-store-alt"></i></span>
                                                        </div>
                                                        {!! Form::select('valor', ['ALGUARISA' => 'ALGUARISA', 'CONVENIO' => 'CONVENIO'], null, ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input type="hidden" name="nombre" value="tienda_fisica">
                                                    <input type="submit" class="btn btn-block btn-primary" value="Guardar">
                                                </div>

                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Modal -->
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
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tiendas as $tienda)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $i++ }}</th>
                                        <td>{{ $tienda->municipios->nombre_corto }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['fisica.parametro', $tienda->id], 'method' => 'DELETE', 'id' => 'form_parametro_'.$tienda->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'fisica.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $tienda->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'fisica.parametro') || Auth::user()->role == 100)
                                                    <button type="button" onclick="alertaBorrar('form_parametro_{{ $tienda->id }}')" class="btn btn-info show-alert-{{ $tienda->id }}"><i class="fas fa-trash"></i></button>
                                                @endif
                                            </div>
                                        {!! Form::close() !!}

                                        <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $tienda->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['fisica.update', $tienda->id], 'method' => 'PUT']) !!}

                                                            <div class="form-group">
                                                                <label for="name">Municipio</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    {!! Form::select('tabla_id', $municipios, $tienda->tabla_id, ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Condición Tienda</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-store-alt"></i></span>
                                                                    </div>
                                                                    {!! Form::select('valor', ['ALGUARISA' => 'ALGUARISA', 'CONVENIO' => 'CONVENIO'], $tienda->valor, ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <input type="hidden" name="nombre" value="tienda_fisica">
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

                        {{--<div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $tiendas->render() }}
                                </span>
                            </div>
                        </div>--}}



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
