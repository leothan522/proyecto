@extends("layouts.android.master")

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{ strtoupper($municipio->nombre_corto) }}</h2>
            <h5>{{ strtoupper($parroquia->nombre_completo) }}</h5>
        </div>
    </div>
    <div class="row justify-content-center p-1">

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-truck-moving"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Operativos Tienda Movil</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_ferias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <!-- /.info-box -->

		<div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Familias Atendidas</span>
                    <span class="info-box-number">

                        {{ formatoMillares($total_familias, 0) }}

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <!-- /.info-box -->

        <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-pink elevation-1"><i class="fa fa-cubes"></i></span>
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
                    <h3 class="card-title">Histórico</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">

                    <ul class="nav nav-pills flex-column">
                        @foreach ($ferias as $feria)
                            @php($i++)
                        <li class="nav-item active">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-{{ $feria->id }}">
                                <span CLASS="text-sm">{{ $i }}.- {{ fechaFeria($feria->fecha) }}</span>
                                <span class="float-right justify-content-center row col-5">
                                    <span class="badge bg-purple col-5">{{ formatoMillares($feria->familias, 0) }}</span>
									<span class="col-1"></span>
									<span class="badge bg-pink col-5">{{ formatoMillares($feria->tm, 2) }}</span>
                                </span>
                            </a>
                        </li>
                            <!-- Modal -->
                            {{--<div class="modal fade" id="modal-{{ $feria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CLAP <span class="text-bold">{{ $feria->nombre_clap }}</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                @if($feria->programa == "BMS")
                                                    <div class="col-md-2">
                                                    <label for="name">Programa</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ $feria->programa }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($feria->programa == "CLAP")
                                                    <div class="col-md-2">
                                                    <label for="name">Bloque</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ $feria->parametros->valor }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                    <div class="col-md-2">
                                                        <label for="name">Nº Familias</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                            </div>
                                                            <span class="form-control">{{ formatoMillares($feria->num_familias, 0) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="name">Nº Lideres de Calle</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-child"></i></span>
                                                            </div>
                                                            <span class="form-control">{{ formatoMillares($feria->num_lideres, 0) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="name">Última Atención</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <span class="form-control">
                                                                @if($feria->periodo)
                                                                    {{ fecha($feria->periodo) }}
                                                                    <span class="badge badge-warning">{{ cuantosDias($feria->periodo, date('Y-m-d')) }} Días</span>
                                                                @else
                                                                    No registrado
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-navy collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Jefe de Comunidad</h3>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <!-- /.card-tools -->
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="name">Cédula</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ formatoMillares($feria->cedula_lider, 0) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="name">Nombre del Responsable</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                                        </div>
                                                                        <span class="form-control text-sm">
                                                                            {{ strtoupper($feria->primer_nombre_lider) }}
                                                                            {{ strtoupper($feria->segundo_nombre_lider) }}
                                                                            {{ strtoupper($feria->primer_apellido_lider) }}
                                                                            {{ strtoupper($feria->segundo_apellido_lider) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="name">N° DE TELÉFONO 1</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($feria->telefono_1_lider) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="name">Email</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                                        </div>
                                                                        <span class="form-control text-sm">{{ strtolower($feria->email_lider) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="name">Fecha de Nacimiento</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ fecha($feria->fecha_nac_lider, 'd-m-Y') }} ({{ str_replace('hace ', '', haceCuanto($feria->fecha_nac_lider)) }})</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="name">Profesión</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($feria->profesion_lider) }}</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                            @if(strtoupper($feria->productivo) == "SI")
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
                                                                        <span class="form-control">{{ strtoupper($feria->productivo) }}</span>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="name">Tipo de Producción</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-cogs"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($feria->tipo_produccion) }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="name">Detalles de Producción</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="attachment-block col-md-12 clearfix">
                                                                            <div class="attachment-text">
                                                                                {{ strtoupper(trim($feria->detalles_produccion)) }}
                                                                            </div>
                                                                        </div>
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
                                                                        <span class="form-control">{{ strtoupper($feria->longitud) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="name">Latitud</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($feria->latitud) }}</span>
                                                                    </div>
                                                                </div>
                                                                --}}{{--<div class="col-md-4">
                                                                    <label for="name">Google Maps</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                        </div>
                                                                        <span class="form-control">{{ strtoupper($feria->google_maps) }}</span>
                                                                    </div>
                                                                </div>--}}{{--
                                                                <div class="col-md-12">
                                                                    <label for="name">Dirección</label>
                                                                    <div class="input-group mb-3">
                                                                        <p class="form-control">{{ strtoupper(trim($feria->direccion)) }}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                            --}}{{--<br>--}}{{--
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                            <!-- /Modal -->

                        @endforeach
                    </ul>

                </div>
                <!-- /.card-body -->
            </div>

        </div>

    </div>



@endsection
