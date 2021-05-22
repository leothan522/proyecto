@extends("layouts.android.master")

@section('content')
    {{--<div class="col-md-12 text-center">
        <h2>Estado Guárico</h2>
    </div>--}}
    <div class="row justify-content-center p-1">

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clone"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Claps Estadal</span>
                    <span class="info-box-number">
                        @if($claps)
                            {{ formatoMillares($claps->valor, 0) }}
                            @else
                            0
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Familias Estadal</span>
                    <span class="info-box-number">
                        @if($estadal)
                            {{ formatoMillares($estadal->valor, 0) }}
                        @else
                            0
                        @endif
                </span>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>

    <div class="row justify-content-center p-1">
        <div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">N° por Municipios</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($municipios as $municipio)
                        <li class="nav-item active">
                            <a href="{{ route('android.modulo_clap_municipio',[Auth::user()->id, $municipio->id]) }}" class="nav-link" onclick="verCargando()">
                                <span class="text-sm">{{ $municipio->nombre_completo }}</span>
                                <span class="float-right justify-content-center row col-5">
                                    <span class="badge bg-success col-5">{{ formatoMillares($municipio->claps, 0) }}</span>
                                    <span class="col-2"></span>
                                    <span class="badge bg-warning col-5">{{ formatoMillares($municipio->familias, 0) }}</span>
                                </span>

                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="row justify-content-center p-1">
        <div class="col-12">
            <div class="card card-navy collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Semáforo Planificación Bloques</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($bloques as $municipio)
                            <li class="nav-item active">
                                <a href="{{ route('android.modulo_clap_municipio',[Auth::user()->id, $municipio->id]) }}" class="nav-link" onclick="verCargando()">
                                    <span class="row text-sm text-bold {{ semaforoDias($municipio->promedio, true) }}">{{ $municipio->nombre_completo }}</span>
                                    <span class="row text-sm">
                                        @php($cont = 0)
                                        @foreach($municipio->bloques as $bloque)
                                            @php($cont++)
                                        <span class="col-2">
                                            @if($bloque->valor != 'BMS') <i class="fas fa-cubes"></i> @endif
                                                {{ $bloque->valor }}
                                                <span class="float-right badge {{ semaforoDias(cuantosDias($bloque->ultima, date('Y-m-d'))) }}">{{ cuantosDias($bloque->ultima, date('Y-m-d')) }}</span>
                                        </span>
                                        @endforeach
                                        @for($cont; $cont < 5; $cont++)
                                            <span class="col-2">{{--<i class="fas fa-cubes"></i> 1<span class="float-right badge bg-success"></span>--}}</span>
                                        @endfor
                                        {{--<span class="col-2"><i class="fas fa-cubes"></i> 1<span class="float-right badge bg-success">99</span></span>
                                        <span class="col-2"><i class="fas fa-cubes"></i> 1<span class="float-right badge bg-success">99</span></span>
                                        <span class="col-2"><i class="fas fa-cubes"></i> 1<span class="float-right badge bg-success">99</span></span>
                                        <span class="col-2">--}}{{--<i class="fas fa-cubes"></i>--}}{{-- BMS<span class="float-right badge bg-success">99</span></span>--}}
                                    </span>
                                    {{--<span class="float-right justify-content-center row col-5">
                                        <span class="badge bg-success col-5">{{ formatoMillares($municipio->claps, 0) }}</span>
                                        <span class="col-2"></span>
                                        <span class="badge bg-warning col-5">{{ formatoMillares($municipio->familias, 0) }}</span>
                                    </span>--}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="row justify-content-center p-1">
        <div class="col-md-3">
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
                <!-- /.progress-group -->
                <div class="progress-group">
                    <span class="progress-text">Total</span>
                    <span class="float-right"><b>{{ formatoMillares($programa_clap + $programa_bms, 0) }}</b>/{{ formatoMillares($claps->valor, 0) }}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar {{ colorBarra(obtenerPorcentaje($programa_clap + $programa_bms, $claps->valor)) }}" style="width: {{ obtenerPorcentaje($programa_clap + $programa_bms, $claps->valor) }}%">{{ obtenerPorcentaje($programa_clap + $programa_bms, $claps->valor) }}%</div>
                    </div>
                </div>
                <!-- /.progress-group -->
            </div>
        </div>
    </div>



@endsection
