@extends("layouts.android.master")

@section('content')
    {{--<div class="col-md-12 text-center">
        <h2>Estado Guárico</h2>
    </div>--}}
    <div class="row justify-content-center p-1">

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-orange elevation-1"><i class="fa fa-tachometer"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Ferias Campo Soberano </span>
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
                <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Familias Atendidas</span>
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
		
		<div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-indigo elevation-1"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° TM Distribuidas</span>
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
                            <a href="{{ route('android.ferias_campo_municipio',[Auth::user()->id, $municipio->id]) }}" class="nav-link" onclick="verCargando()">
                                <span class="text-sm">{{ $municipio->nombre_corto }}</span>
                                <span class="float-right justify-content-center row col-8">
                                    <span class="badge bg-orange col-3">{{ formatoMillares($municipio->claps, 0) }}</span>
                                    <span class="col-1"></span>
									<span class="badge bg-maroon col-3">{{ formatoMillares($municipio->claps, 0) }}</span>
                                    <span class="col-1"></span>
                                    <span class="badge bg-indigo col-3">{{ formatoMillares($municipio->familias, 0) }}</span>
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
