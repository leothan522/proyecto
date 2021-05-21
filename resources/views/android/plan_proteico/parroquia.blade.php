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
                <span class="info-box-icon bg-lime elevation-1"><i class="fa fa-external-link"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Operativos Plan Proteico</span>
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
        <!-- /.info-box -->

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
                                    <span class="badge bg-fuchsia col-5">{{ formatoMillares($feria->familias, 0) }}</span>
									<span class="col-1"></span>
									<span class="badge bg-lightblue col-5">{{ formatoMillares($feria->tm, 2) }}</span>
                                </span>
                            </a>
                        </li>
                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{ $feria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ fechaFeria($feria->fecha) }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <label for="name">Municipio</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ $feria->municipios->nombre_corto }}</span>
                                                    </div>
                                                </div>


                                                <div class="col-md-2">
                                                    <label for="name">Parroquia</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ $feria->parroquias->nombre_completo }}</span>
                                                    </div>
                                                </div>

                                                    <div class="col-md-2">
                                                        <label for="name">Nº Familias Atendidas</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                            </div>
                                                            <span class="form-control">{{ formatoMillares($feria->familias, 0) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="name">Nº TM Distribuidas</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                                            </div>
                                                            <span class="form-control">{{ formatoMillares($feria->tm) }}</span>
                                                        </div>
                                                    </div>
                                                <div class="col-md-2">
                                                    <label for="name">Procedencia</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                        </div>
                                                        <span class="form-control">{{ $feria->parametros->valor }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="name">Rubros Distribuidos</label>
                                                    <div class="input-group mb-3">

                                                        @if($feria->rubros)
                                                            @php($products = json_decode($feria->rubros, true))
                                                            <ul>
                                                                @foreach($products as $clave => $valor)
                                                                    <li>{{ $clave }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                            {{--<br>--}}
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

    </div>



@endsection
