@extends("layouts.android.master")

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{ strtoupper($municipio->nombre_corto) }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clone"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Claps</span>
                    <span class="info-box-number">
                        @if($claps)
                            {{ formatoMillares($claps->valor, 0) }}
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
                    <span class="info-box-text">N° Familias</span>
                    <span class="info-box-number">
                        @if($familias)
                            {{ formatoMillares($familias->valor, 0) }}
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
                    <h3 class="card-title">N° por Parroquias</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($parroquias as $parroquia)
                        <li class="nav-item active">
                            <a href="{{ route('android.modulo_clap_parroquia', [Auth::user()->id, $municipio->id, $parroquia->id]) }}" class="nav-link" onclick="verCargando()">
                                {{--<i class="fas fa-flag"></i>--}} {{ $parroquia->nombre_completo }}
                                <span class="float-right justify-content-center row col-5">
                                    <span class="badge bg-success col-5">{{ formatoMillares($parroquia->claps, 0) }}</span>
                                    <span class="col-2"></span>
                                    <span class="badge bg-warning col-5">{{ formatoMillares(0, 0) }}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">N° por Bloques</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                @if('$bloques')
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($bloques as $bloque)
                        <li class="nav-item active">
                            <a href="{{ route('android.modulo_clap_bloque', [Auth::user()->id, $municipio->id, $bloque->id]) }}" class="nav-link" onclick="verCargando()">
                                <i class="fas fa-cubes"></i> {{ $bloque->valor }}
                                <span class="float-right justify-content-center row col-5">
                                    <span class="badge bg-success col-5">{{ formatoMillares($bloque->claps, 0) }}</span>
                                    <span class="col-2"></span>
                                    <span class="badge bg-warning col-5">{{ formatoMillares($bloque->familias, 0) }}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.card-body -->
            </div>
        </div>
    </div>



@endsection
