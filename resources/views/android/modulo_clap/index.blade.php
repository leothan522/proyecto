@extends("layouts.android.master")

@section('content')
    {{--<div class="col-md-12 text-center">
        <h2>Estado Guárico</h2>
    </div>--}}
    <div class="row">
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
        <!-- /.info-box -->
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
    <div class="row">
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
                                {{--<i class="fas fa-flag"></i>--}} {{ $municipio->nombre_completo }}
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
        {{--<div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">N° Familias por Municipios</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($municipios as $municipio)
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                --}}{{--<i class="fas fa-flag"></i>--}}{{-- {{ $municipio->nombre_completo }}
                                <span class="badge bg-warning float-right">12</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>--}}
    </div>



@endsection
