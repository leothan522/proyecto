@extends("layouts.android.master")

@section('content')

    <div class="row mb-3 justify-content-center">
        {{--{!! Form::open(['route' => ['android.modulo_clap_buscar', Auth::user()->id], 'method' => 'POST']) !!}
        <div class="input-group">
            <input type="text" name="buscar" placeholder="Buscar CLAP" class="form-control" required>
            <input type="hidden" name="id_municipio" value="{{ $municipio->id }}">
            <input type="hidden" name="id_parroquia" value="{{ $parroquia->id }}">
            <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </span>
        </div>
        {!! Form::close() !!}--}}
        <h5>Resultados para: <b> {{ strtoupper($buscar) }}</b></h5>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title col-10">Listado de Cédulas <span class="float-right text-bold">{{ formatoMillares($resultados->count(), 0) }}</span></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        {{--<a href="{{ route('android.modulo_clap_parroquia', [Auth::user()->id, $municipio->id, $parroquia->id]) }}"
                        class="btn btn-tool">
                            <i class="fa fa-times"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($resultados as $clap)
                            @php($i++)
                            <li class="nav-item active">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-{{ $clap->id }}">
                                    <span class="text-xs">{{ $i }}.-</span> <span class="text-bold">{{ formatoMillares($clap->cedula_lider, 0) }}</span>
                                    <span class="float-right text-sm">
                                         {{ $clap->primer_nombre_lider }} {{ $clap->segundo_nombre_lider }} {{ $clap->primer_apellido_lider }} {{ $clap->segundo_apellido_lider }}
                                    </span>
                                </a>
                            </li>
                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{ $clap->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CLAP <span class="text-bold">{{ $clap->nombre_clap }}</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="name">Cédula</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ formatoMillares($clap->cedula_lider, 0) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="name">Nombre del Responsable</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                        <span class="form-control text-sm">
                                                            {{ strtoupper($clap->primer_nombre_lider) }}
                                                            {{ strtoupper($clap->segundo_nombre_lider) }}
                                                            {{ strtoupper($clap->primer_apellido_lider) }}
                                                            {{ strtoupper($clap->segundo_apellido_lider) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="name">N° DE TELÉFONO 1</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ strtoupper($clap->telefono_1_lider) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="name">Email</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <span class="form-control text-sm">{{ strtolower($clap->email_lider) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="name">Fecha de Nacimiento</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ fecha($clap->fecha_nac_lider, 'd-m-Y') }} ({{ str_replace('hace ', '', haceCuanto($clap->fecha_nac_lider)) }})</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="name">Profesión</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ strtoupper($clap->profesion_lider) }}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-navy collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Datos del CLAP</h3>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <!-- /.card-tools -->
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label for="name">Municipio</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ $clap->municipios->nombre_completo }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="name">Parroquia</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ $clap->parroquias->nombre_completo }}</span>
                                                                    </div>
                                                                </div>
                                                                @if($clap->programa == "BMS")
                                                                    <div class="col-md-2">
                                                                        <label for="name">Programa</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                                                            </div>
                                                                            <span class="form-control">{{ $clap->programa }}</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if($clap->programa == "CLAP")
                                                                    <div class="col-md-2">
                                                                        <label for="name">Bloque</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                                            </div>
                                                                            <span class="form-control">{{ $clap->parametros->valor }}</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-2">
                                                                    <label for="name">Nº Familias</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ formatoMillares($clap->num_familias, 0) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="name">Nº Lideres de Calle</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ formatoMillares($clap->num_lideres, 0) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="name">Última Atención</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                                        </div>
                                                                        <span class="form-control">
                                                            @if($clap->periodo)
                                                                                {{ fecha($clap->periodo) }}
                                                                                <span class="badge badge-warning">{{ cuantosDias($clap->periodo, date('Y-m-d')) }} Días</span>
                                                                            @else
                                                                                No registrado
                                                                            @endif
                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                            @if($clap->productivo == "SI")
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-navy collapsed-card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Datos Productivos</h3>

                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                                <!-- /.card-tools -->
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="name">CLAP Productivo</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
                                                                            </div>
                                                                            <span class="form-control">{{ strtoupper($clap->productivo) }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="name">Tipo de Producción</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-cogs"></i></span>
                                                                            </div>
                                                                            <span class="form-control">{{ strtoupper($clap->tipo_produccion) }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label for="name">Detalles de Producción</label>
                                                                        <div class="input-group mb-3">
                                                                            <p class="form-control">{{ strtoupper(trim($clap->detalles_produccion)) }}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-navy collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Geolocalización</h3>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <!-- /.card-tools -->
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="name">Longitud</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($clap->longitud) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="name">Latitud</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($clap->latitud) }}</span>
                                                                    </div>
                                                                </div>
                                                                {{--<div class="col-md-4">
                                                                    <label for="name">Google Maps</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($clap->google_maps) }}</span>
                                                                    </div>
                                                                </div>--}}
                                                                <div class="col-md-12">
                                                                    <label for="name">Dirección</label>
                                                                    <div class="input-group mb-3">
                                                                        <p class="form-control">{{ strtoupper(trim($clap->direccion)) }}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal -->

                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{--<div class="col-12">
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
                            <a href="#" class="nav-link">
                                <i class="fas fa-cubes"></i> {{ $bloque->valor }}
                                <span class="float-right">
                                    <span class="badge bg-success">{{ formatoMillares($bloque->claps, 0) }}</span>
                                    <span class="badge bg-warning">{{ formatoMillares($bloque->familias, 0) }}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.card-body -->
            </div>
        </div>--}}
    </div>

@endsection
