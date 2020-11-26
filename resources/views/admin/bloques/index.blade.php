@extends('layouts.admin.master')

@section('title', 'Bloques')

@section('header', 'Bloques')

@section('breadcrumb')
    <li class="breadcrumb-item active">Bloques por Municipio</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    <script>
        jQuery(function ($) {
            $('.table').footable();
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Bloques Registrados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-cubes"></i></span>
                        </div>
                    </div>
                    <div class="card-body">


                        <table class="table table-hover bg-light">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                <th scope="col">Municipios</th>
                                <th scope="col" class="text-center">N° Bloques</th>
                                <th scope="col" data-breakpoints="xs" style="width: 10%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($municipios as $municipio)
                                <tr>
                                    <th scope="row" class="text-center">{{ $i++ }}</th>
                                    <td>{{ strtoupper($municipio->nombre_completo) }}</td>
                                    <td class="text-center text-bold">{{ cerosIzquierda(formatoMillares($municipio->bloques, 0)) }}</td>
                                    <td class="">

                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'bloques.destroy') || Auth::user()->role == 100)
                                                {!! Form::open(['route' => ['bloques.destroy', $municipio->id], 'method' => 'DELETE']) !!}
                                                    @if ($municipio->bloques > 0)
                                                        <button type="submit" class="btn text-danger"><i class="fas fa-minus-circle"></i></button>
                                                        @else
                                                        <button type="button" class="btn text-danger disabled"><i class="fas fa-minus-circle"></i></button>
                                                    @endif

                                                {!! Form::close() !!}
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'bloques.store') || Auth::user()->role == 100)
                                                {!! Form::open(['route' => 'bloques.store', 'method' => 'POST']) !!}
                                                    <input type="hidden" name="nombre" value="bloques">
                                                    <input type="hidden" name="tabla_id" value="{{ $municipio->id }}">
                                                    <input type="hidden" name="valor" value="{{ $municipio->bloques + 1 }}">
                                                    @if ($municipio->bloques < 4)
                                                        <button type="submit" class="btn text-success"><i class="fas fa-plus-circle"></i></button>
                                                    @else
                                                        <button type="button" class="btn text-success disabled"><i class="fas fa-plus-circle"></i></button>
                                                    @endif

                                                {!! Form::close() !!}
                                            @endif
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $municipios->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
