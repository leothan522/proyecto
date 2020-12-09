@extends('layouts.admin.master')

@section('title', 'Parroquias')

@section('header', 'Parroquias')

@section('breadcrumb')
    <li class="breadcrumb-item active">Parroquias Registradas</li>
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
            @if (leerJson(Auth::user()->permisos, 'parroquias.store') || Auth::user()->role == 100)
                <div class="col-md-3">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h5 class="card-title">Nueva Parroquia</h5>
                            <div class="card-tools">
                                <span class="btn btn-tool"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'parroquias.store', 'method' => 'post']) !!}

                            <div class="form-group">
                                <label for="name">Municipio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    {!! Form::select('municipios_id', $municipios, null , ['class' => 'custom-select select2bs4', 'placeholder' => 'Seleccione', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre de la Parroquia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    {!! Form::text('nombre_completo', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Abreviado</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    {!! Form::text('nombre_corto', null, ['class' => 'form-control', 'placeholder' => 'Nombre Corto', 'required']) !!}
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
                </div>
            @endif
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Parroquias Registradas</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-tags"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Abreviado</th>
                                    <th scope="col">Municipio</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($parroquias as $parroquia)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $i++ }}</th>
                                        <td>{{ strtoupper($parroquia->nombre_completo) }}</td>
                                        <td>{{ strtoupper($parroquia->nombre_corto) }}</td>
                                        <td>{{ strtoupper($parroquia->municipios->nombre_corto) }}</td>
                                        <td class="">
                                            {!! Form::open(['route' => ['parroquias.destroy', $parroquia->id], 'method' => 'DELETE', 'id' => 'form_delete_'.$parroquia->id]) !!}
                                            <div class="btn-group">
                                                @if (leerJson(Auth::user()->permisos, 'parroquias.update') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-{{ $parroquia->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    {{--<a href="{{ route('usuarios.show', $municipio->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>--}}
                                                @endif
                                                @if (leerJson(Auth::user()->permisos, 'parroquias.destroy') || Auth::user()->role == 100)
                                                    <button type="button" class="btn btn-info show-alert-{{ $parroquia->id }}"><i class="fas fa-trash"></i></button>
                                                        <script>
                                                            $(document).on("click", ".show-alert-{{ $parroquia->id }}", function(e) {
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
                                                                            document.getElementById('form_delete_{{ $parroquia->id }}').submit();
                                                                        }
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                @endif
                                            </div>
                                            {!! Form::close() !!}

                                        <!-- Modal -->
                                            <div class="modal fade" id="modal-{{ $parroquia->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Parroquia</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::open(['route' => ['parroquias.update', $parroquia->id], 'method' => 'PUT']) !!}

                                                            <div class="form-group">
                                                                <label for="name">Municipio</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    {!! Form::select('municipios_id2', $municipios, $parroquia->municipios_id , ['class' => 'custom-select']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Nombre de la Parroquia</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    {!! Form::text('nombre_completo2', $parroquia->nombre_completo, ['class' => 'form-control', 'placeholder' => 'Nombre Completo', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Abreviado</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                    </div>
                                                                    {!! Form::text('nombre_corto2', $parroquia->nombre_corto, ['class' => 'form-control', 'placeholder' => 'Nombre Corto', 'required']) !!}
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
                                {{ $parroquias->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
