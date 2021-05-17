@extends("layouts.android.master")

@section('content')
    <div class="col-md-12 text-center">
        <h2>{{ strtoupper($municipio->municipios->nombre_corto) }}</h2>
        {{--<h5>({{ strtoupper($municipio->valor) }})</h5>--}}
    </div>
    <div class="row justify-content-center p-1">

        {{--<div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-truck-moving"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Operativos Tienda Movil </span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_ferias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>--}}

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Familias Atendidas</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_familias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-teal elevation-1"><i class="fa fa-cubes
"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° TM Distribuidas</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_tm, 2) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

    </div>

    <div class="row justify-content-center p-1">
        <div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">N° por Plataformas</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($ferias as $feria)
                            <li class="nav-item active">
                                <a href="{{ route('android.tienda_enlinea_parroquia',[Auth::user()->id, $municipio->id, $feria->plataforma]) }}" class="nav-link" onclick="verCargando()">
                                    <span class="text-sm">{{ $feria->plataforma }}</span>
                                    <span class="float-right justify-content-center row col-5">
                                    {{--<span class="badge bg-primary col-3">{{ formatoMillares($feria->ferias, 0) }}</span>
                                    <span class="col-1"></span>--}}
									<span class="badge bg-primary col-5">{{ formatoMillares($feria->familias, 0) }}</span>
                                    <span class="col-2"></span>
                                    <span class="badge bg-teal col-5">{{ formatoMillares($feria->tm, 2) }}</span>
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
