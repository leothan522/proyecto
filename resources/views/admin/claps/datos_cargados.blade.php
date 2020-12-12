@extends('layouts.admin.master')

@section('title', 'CLAPS')

@section('header', 'CLAPS')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('claps.index') }}">CLAPS Registrados</a></li>
    <li class="breadcrumb-item active">Datos Cargados</li>
@endsection

@section('link')

@endsection

@section('script')
    <script>
        function cambiar() {
            var pdrs = document.getElementById('customFileLang').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }

        document.addEventListener('DOMContentLoaded', function () {
            var detalles_import = document.getElementById('detalles_import');
            var boton_cerrar = document.getElementById('boton_cerrar');
            boton_cerrar.addEventListener('click', function () {
                detalles_import.classList.add('d-none');
            });
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clone"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">N° Total CLAPS</span>
                            <span class="info-box-number">
                                {{ cerosIzquierda(formatoMillares($total_claps, 0)) }}
                                @if ($total_claps > 0)
                                    @if (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100)
                                        <span class="float-right">
                                        <a href="{{ route('claps.export') }}" class="text-muted"><i
                                                class="fas fa-cloud-download-alt"></i></a>
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
                                <a href="{{ route('claps.show', 'datos-cargados') }}" class="text-muted">N° CLAPS <i class="fa fa-refresh text-xs"></i></a>
                                <span class="float-right"><b>{{ formatoMillares($total_claps, 0) }}</b>/{{ formatoMillares($claps_estadal, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary"
                                         style="width: {{ obtenerPorcentaje($total_claps, $claps_estadal) }}%">{{ obtenerPorcentaje($total_claps, $claps_estadal) }}
                                        %
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="col-md-12">
                        <div class="card-body">

                            <p class="text-center">
                                <strong>Municipios / CLAPS</strong>
                            </p>
                            @foreach ($municipios as $municipio)
                                <div class="progress-group">
                                    @if ($municipio->claps && (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100))
                                        <a href="{{ route('claps.export', ['municipios_id' => $municipio->id, 'parroquias_id' => null,
                                          'bloques_id' => null, 'nombre_clap' => null, 'codigo_sica' => null, 'cedula_lider' => null, 'buscar' => true, 'datos_cargados' => true]) }}"
                                           class="text-muted"><i class="fas fa-cloud-download-alt text-sm"></i> {{ $municipio->nombre_completo }}</a>
                                        @else
                                        <span class="text-muted">{{ $municipio->nombre_completo }}</span>
                                    @endif
                                    <span class="float-right @if($municipio->claps && !$municipio->total_claps) text-danger @endif">
                                        @if($municipio->claps && !$municipio->total_claps) <a href="{{ route('familias.index') }}" class="text-xs text-danger">(Error)</a> @endif
                                            <b>{{ formatoMillares($municipio->claps, 0) }}</b>/{{ formatoMillares($municipio->total_claps, 0) }}</span>
                                    <div class="progress progress-sm">
                                        <div
                                            class="progress-bar {{ colorBarra(obtenerPorcentaje($municipio->claps, $municipio->total_claps)) }}"
                                            style="width: {{ obtenerPorcentaje($municipio->claps, $municipio->total_claps) }}%">
                                            {{ obtenerPorcentaje($municipio->claps, $municipio->total_claps) }}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-8 text-right p-3">
                <a href="javascript:history.back()"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>
@endsection
