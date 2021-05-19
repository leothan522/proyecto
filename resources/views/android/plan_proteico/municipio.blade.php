@extends("layouts.android.master")

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{ strtoupper($municipio->nombre_corto) }}</h2>
        </div>
    </div>
    <div class="row justify-content-center p-1">

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-lime elevation-1"><i class="fa fa-external-link"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Operativos Plan Proteico</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_ferias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-fuchsia elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Familias Atendidas</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_familias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-lightblue elevation-1"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° TM Distribuidas</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_tm, 2) }}

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
                    <h3 class="card-title">N° por Parroquias</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($parroquias as $parroquia)
                            <li class="nav-item active">
                                <a href="{{ route('android.plan_proteico_parroquia', [Auth::user()->id, $municipio->id, $parroquia->id]) }}" class="nav-link" onclick="verCargando()">
                                    <span class="text-sm">{{ $parroquia->nombre_completo }}
                                    <span class="float-right justify-content-center row col-8">
                                        <span class="badge bg-lime col-3">{{ formatoMillares($parroquia->ferias, 0) }}</span>
                                        <span class="col-1"></span>
										<span class="badge bg-fuchsia col-3">{{ formatoMillares($parroquia->familias, 0) }}</span>
                                        <span class="col-1"></span>
                                        <span class="badge bg-lightblue col-3">{{ formatoMillares($parroquia->tm, 2) }}</span>
                                    </span>
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



@endsection
