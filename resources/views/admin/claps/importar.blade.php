@extends('layouts.admin.master')

@section('title', 'CLAPS')

@section('header', 'CLAPS')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('claps.get_revision_export', 0) }}"><i class="fas fa-download"></i> Formato Excel</a></li>
    <li class="breadcrumb-item active">Importar CLAPS</li>
@endsection

@section('link')

@endsection

@section('script')
    <script>
        function cambiar(){
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
            <div class="col-md-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Importar Data Excel</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-cloud-upload-alt"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'claps.post_import', 'method' => 'post', 'files' => true]) !!}

                        <div class="form-group">
                            <label for="name">Subir Archivo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-excel"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="excel" class="custom-file-input" id="customFileLang" onchange='cambiar()' lang="es" accept=".xlsx,.xls" required>
                                    <label class="custom-file-label" for="customFileLang" data-browse="Elegir" id="info">Seleccionar Archivo</label>
                                </div>
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
                            <input type="submit" class="btn btn-block btn-primary" value="Importar">
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-navy collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Historico (Importaciones)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: none;">
                        @foreach($parametros as $parametro)
                            <div class="progress-group">
                                <a href="{{ route('claps.get_import', $parametro->id) }}" class="{{ $parametro->class }}">{{ fecha($parametro->created_at, 'd-m-Y h:i a') }}</a>
                                <span class="float-right text-muted text-xs"><i class="fa fa-user"></i> {{ $parametro->usuarios->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        @if ($id_import)
            <div class="card-body" id="detalles_import">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="col-12 col-sm-6 col-md-12">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clone"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">N° CLAPS (Procesados)</span>
                                <span class="info-box-number">
                                {{ cerosIzquierda(formatoMillares($claps_procesados, 0)) }}
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="card card-body" style="display: block;">
                            <span class="text-muted">{{ fecha($detalle_import->created_at, 'd-m-Y h:i a') }}</span>
                            <span class="float-right text-muted text-xs"><i class="fa fa-user"></i> {{ $detalle_import->usuarios->name }}</span>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3">
                    <div class="card-body">

                        <p class="text-center">
                            <strong>Cargados Correctamente</strong>
                        </p>

                        @foreach ($claps_cargados as $claps)
                            <div class="progress-group">
                                <a href="{{ route('claps.index', ['municipios_id' => $claps->municipios_id, 'parroquias_id' => null,
                            'bloques_id' => null, 'nombre_clap' => null, 'codigo_sica' => null, 'cedula_lider' => null, 'buscar' => true]) }}" class="text-muted">{{ $claps->nombre }}</a>
                                <span class="float-right"><b>{{ formatoMillares($claps->total, 0) }}</b>/{{ formatoMillares($claps_procesados, 0) }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width: {{ obtenerPorcentaje($claps->total, $claps_procesados) }}%">{{ formatoMillares(obtenerPorcentaje($claps->total, $claps_procesados), 0) }}%</div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                        @endforeach

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-body">

                        <p class="text-center">
                            <strong>Por Revisión</strong>
                        </p>

                        <div class="progress-group">
                            @if ($import_claps > 0)
                                <a href="{{ route('claps.get_revision', $id_import) }}" class="text-muted">N° CLAPS</a>
                                @else
                                <span class="text-muted">N° CLAPS</span>
                            @endif
                            <span class="float-right"><b>{{ formatoMillares($import_claps, 0) }}</b>/{{ formatoMillares($claps_procesados, 0) }}</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: {{ obtenerPorcentaje($import_claps, $claps_procesados) }}%">{{ formatoMillares(obtenerPorcentaje($import_claps, $claps_procesados), 0) }}%</div>
                            </div>
                        </div>
                        <!-- /.progress-group -->

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 text-right p-3">
                    <button class="btn text-primary" id="boton_cerrar"><i class="fas fa-arrow-circle-up"></i> Cerrar</button>
                </div>
            </div>
            </div>
        @endif
    </div>
@endsection
