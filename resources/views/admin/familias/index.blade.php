@extends('layouts.admin.master')

@section('title', 'Familias')

@section('header', 'Familias')

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
                    @if ($estadal)
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
                    @endif
                    @if (leerJson(Auth::user()->permisos, 'familias.store') || Auth::user()->role == 100)
                    <div class="card card-navy">
                        <div class="card-header">
                            <h5 class="card-title">Nuevo Parametro</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'familias.store', 'method' => 'post']) !!}

                            @if ($estadal)
                                <input type="hidden" name="nombre" value="familias">
                                <input type="hidden" name="nombre_clap" value="claps">
                                <div class="form-group">
                                    <label for="name">Municipio</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        {!! Form::select('tabla_id', $municipios, null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                    </div>
                                </div>
                                @else
                                <input type="hidden" name="nombre" value="familias_estadal">
                                <input type="hidden" name="nombre_clap" value="claps_estadal">
                                <input type="hidden" name="tabla_id" value="0">
                            @endif
                            <div class="form-group">
                                <label for="name">N° CLAPS</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                    </div>
                                    {!! Form::number('valor_clap', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">N° Familias</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-child"></i></span>
                                    </div>
                                    {!! Form::number('valor', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
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
                        <h5 class="card-title">Familias</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-child"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                    <th scope="col">Municipios</th>
                                    <th scope="col" class="text-center">N° CLAPS</th>
                                    <th scope="col" class="text-center">N° Familias</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($familias as $familia)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $i++ }}</th>
                                        <td>{{ $familia->municipios->nombre_corto }}</td>
                                        <td class="text-center">{{ formatoMillares($familia->claps, 0) }}</td>
                                        <td class="text-center">{{ formatoMillares($familia->valor, 0) }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['familias.destroy', $familia->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$familia->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'familias.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $familia->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'familias.destroy') || Auth::user()->role == 100)
                                                    <input type="hidden" name="id_clap" value="{{ $familia->id_clap }}">
                                                    <button type="button" class="btn btn-info show-alert-{{ $familia->id }}"><i class="fas fa-trash"></i></button>
                                                        <script>
                                                            $(document).on("click", ".show-alert-{{ $familia->id }}", function(e) {
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
                                                                            document.getElementById('form_delete_{{ $familia->id }}').submit();
                                                                        }
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                @endif
                                            </div>
                                            {!! Form::close() !!}

                                        <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $familia->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parametro</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['familias.update', $familia->id], 'method' => 'PUT']) !!}

                                                            <input type="hidden" name="nombre" value="familias">
                                                            <input type="hidden" name="nombre_clap" value="claps">
                                                            <div class="form-group">
                                                                <label for="name">Municipio</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    {!! Form::select('tabla_id2', $municipios, $familia->tabla_id, ['class' => 'custom-select']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">N° CLAPS</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-clone"></i></span>
                                                                    </div>
                                                                    {!! Form::number('valor_clap2', $familia->claps, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
                                                                    <input type="hidden" name="id_clap" value="{{ $familia->id_clap }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">N° Familias</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                                    </div>
                                                                    {!! Form::number('valor2', $familia->valor, ['class' => 'form-control', 'placeholder' => 'Numero', 'min' => 1, 'required']) !!}
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

                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $familias->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
