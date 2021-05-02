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

        var btn_exportar = document.getElementById('btn_exportar');
        var url = btn_exportar.getAttribute('href');
        btn_exportar.addEventListener('click', function (e) {
            e.preventDefault();
            alertExport(url);
        });

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
                                        <a href="{{ route('claps.export') }}" id="btn_exportar" class="text-muted"><i
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

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">N° CLAPS</span>
                                <span class="float-right"><b>{{ formatoMillares($programa_clap, 0) }}</b>{{--/{{ formatoMillares($claps->valor, 0) }}--}}</span>
                                {{--<div class="progress progress-sm">
                                    <div class="progress-bar bg-primary --}}{{--{{ colorBarra(obtenerPorcentaje($programa_clap, $claps->valor)) }}--}}{{--" style="width: {{ obtenerPorcentaje($programa_clap, $claps->valor) }}%">{{ obtenerPorcentaje($programa_clap, $claps->valor) }}%</div>
                                </div>--}}
                            </div>
                            <div class="dropdown-divider"></div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">N° BMS</span>
                                <span class="float-right"><b>{{ formatoMillares($programa_bms, 0) }}</b>{{--/{{ formatoMillares($claps->valor, 0) }}--}}</span>
                                {{--<div class="progress progress-sm">
                                    <div class="progress-bar bg-primary --}}{{--{{ colorBarra(obtenerPorcentaje(100, $claps->valor)) }}--}}{{--" style="width: {{ obtenerPorcentaje($programa_bms, $claps->valor) }}%">{{ obtenerPorcentaje($programa_bms, $claps->valor) }}%</div>
                                </div>--}}
                            </div>
                            <!-- /.progress-group -->
                            <div class="dropdown-divider"></div>
                            <div class="progress-group">
                                <a href="{{ route('claps.show', 'datos-cargados') }}" class="text-muted">Total <i class="fa fa-refresh text-xs"></i></a>
                                <span class="float-right"><b>{{ formatoMillares($total_claps, 0) }}</b>/{{ formatoMillares($claps_estadal, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary"
                                         style="width: {{ obtenerPorcentaje($total_claps, $claps_estadal) }}%">{{ obtenerPorcentaje($total_claps, $claps_estadal) }}
                                        %
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">N° Lideres de Calle</span>
                                <span class="float-right"><b>{{ formatoMillares($lid_cargados, 0) }}</b>/{{ formatoMillares($total_lideres, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar {{ colorBarra(obtenerPorcentaje($lid_cargados, $total_lideres)) }}"
                                         style="width: {{ obtenerPorcentaje($lid_cargados, $total_lideres) }}%">
                                        {{ obtenerPorcentaje($lid_cargados, $total_lideres) }}%
                                    </div>
                                </div>
                            </div>

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">N° Familias</span>
                                <span class="float-right"><b>{{ formatoMillares($fam_cargados, 0) }}</b>/{{ formatoMillares($total_familias, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar {{ colorBarra(obtenerPorcentaje($fam_cargados, $total_familias)) }}"
                                         style="width: {{ obtenerPorcentaje($fam_cargados, $total_familias) }}%">
                                        {{ obtenerPorcentaje($fam_cargados, $total_familias) }}%
                                    </div>
                                </div>
                            </div>
                            <!-- /.progress-group -->


                        </div>
                    </div>

                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3">
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
                                           class="text-muted"><i class="fas fa-cloud-download-alt text-sm"></i> {{ $municipio->nombre_corto }}</a>
                                        <button type="button" onclick="alertaBorrar(null, '{{ route('claps.borrar', $municipio->id) }}')" class="btn btn-link btn-xs text-danger text-sm"><i class="fas fa-trash-alt"></i></button>
                                        @else
                                        <span class="text-muted">{{ $municipio->nombre_corto }}</span>
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
            <div class="col-md-3">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="col-md-12">
                        <div class="card-body">

                            <p class="text-center">
                                <strong>Municipios / Lideres de Calle</strong>
                            </p>
                            @foreach ($municipios as $municipio)
                                <div class="progress-group">
                                    @if (false /*$municipio->claps && (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100)*/)
                                        {{--<a href="#"
                                           class="text-muted"><i class="fas fa-cloud-download-alt text-sm"></i> {{ $municipio->nombre_corto }}</a>
                                        <button type="button" onclick="alertaBorrar(null, '{{ route('claps.borrar', $municipio->id) }}')"
                                        class="btn btn-link btn-xs text-danger text-sm"><i class="fas fa-trash-alt"></i></button>--}}
                                    @else
                                        <span class="text-muted">{{ $municipio->nombre_corto }}</span>
                                    @endif
                                    <span class="float-right @if($municipio->claps && !$municipio->total_claps) text-danger @endif">
                                        {{--@if($municipio->claps && !$municipio->total_claps) <a href="{{ route('familias.index') }}" class="text-xs text-danger">(Error)</a> @endif--}}
                                            <b>{{ formatoMillares($municipio->lid_cargados, 0) }}</b>/{{ formatoMillares($municipio->lideres, 0) }}</span>
                                    <div class="progress progress-sm">
                                        <div
                                            class="progress-bar {{ colorBarra(obtenerPorcentaje($municipio->lid_cargados, $municipio->lideres)) }}"
                                            style="width: {{ obtenerPorcentaje($municipio->lid_cargados, $municipio->lideres) }}%">
                                            {{ obtenerPorcentaje($municipio->lid_cargados, $municipio->lideres) }}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3">
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="col-md-12">
                        <div class="card-body">

                            <p class="text-center">
                                <strong>Municipios / Familias</strong>
                            </p>
                            @foreach ($municipios as $municipio)
                                <div class="progress-group">
                                    @if (false /*$municipio->claps && (leerJson(Auth::user()->permisos, 'claps.export') || Auth::user()->role == 100)*/)
                                        {{--<a href="#"
                                           class="text-muted"><i class="fas fa-cloud-download-alt text-sm"></i> {{ $municipio->nombre_corto }}</a>
                                        <button type="button" onclick="alertaBorrar(null, '{{ route('claps.borrar', $municipio->id) }}')"
                                        class="btn btn-link btn-xs text-danger text-sm"><i class="fas fa-trash-alt"></i></button>--}}
                                    @else
                                        <span class="text-muted">{{ $municipio->nombre_corto }}</span>
                                    @endif
                                    <span class="float-right @if($municipio->claps && !$municipio->total_claps) text-danger @endif">
                                        {{--@if($municipio->claps && !$municipio->total_claps) <a href="{{ route('familias.index') }}" class="text-xs text-danger">(Error)</a> @endif--}}
                                            <b>{{ formatoMillares($municipio->fam_cargados, 0) }}</b>/{{ formatoMillares($municipio->familias, 0) }}</span>
                                    <div class="progress progress-sm">
                                        <div
                                            class="progress-bar {{ colorBarra(obtenerPorcentaje($municipio->fam_cargados, $municipio->familias)) }}"
                                            style="width: {{ obtenerPorcentaje($municipio->fam_cargados, $municipio->familias) }}%">
                                            {{ obtenerPorcentaje($municipio->fam_cargados, $municipio->familias) }}%
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
