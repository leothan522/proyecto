@extends("layouts.android.master")

@section('content')

    @if($personal)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Alimentos del Guarico S.A.
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{ $personal->nombre_completo }}</b></h2>
                        <p class="text-muted text-sm"><b>Cargo: </b> {{ $personal->cargo }} </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> Cédula de Identidad: <b><br>{{ formatoMillares($personal->cedula, 0) }}</b></li>
                            {{--<li class="small"><span class="fa-li"><i class="fas fa-lg fa-user-shield"></i></span> Cargo: <b><br>{{ $personal->cargo }}</b></li>--}}
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Ubicación Administrativa: <b><br>{{ $personal->ubicacion_administrativa }}</b></li>
                            <br>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user-alt"></i></span> Estatus: <b>{{ $personal->estatus }}</b></li>
                            {{--<li class="small"><span class="fa-li"><i class="fas fa-lg fa-image"></i></span> Url:  {{ "img/personal/".cerosIzquierda($personal->id,3)."_CI_".$personal->cedula."/".cerosIzquierda($personal->id,3)."_".$personal->cedula.".jpg" }}</li>--}}
                            {{--<li class="small"><span class="fa-li"><i class="fas fa-lg fa-image"></i></span> DB:  {{ $personal->foto_perfil }}</li>--}}
                        </ul>
                    </div>
                    <div class="col-5 text-center fixed">
                        <img src="{{ verFotosPersonal("img/personal/".cerosIzquierda($personal->id,3)."_CI_".$personal->cedula."/".cerosIzquierda($personal->id,3)."_".$personal->cedula) }}"
                             alt="user-avatar" class="img-circle img-fluid" style="width: 150px !important; height: 150px !important;">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-left user-block">
                    <img src="{{ asset('img/logo_gobernacion.png') }}" class="img-thumbnail" width="50%" alt="Logo Gobernacion Guarico">
                    <img src="{{ asset('img/alguarisa_logo_original.jpg') }}" class="img-thumbnail" alt="Logo Alguarisa">
                </div>
                <div class="text-right">
                    <a href="tel:04144453149" class="btn btn-sm bg-teal">
                        <i class="fas fa-phone-alt"></i> | Oficina de RRHH
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                Alimentos del Guarico S.A.
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="lead"><b>PERSONAL NO ENCONTRADO</b></h2>
                       {{-- <p class="text-muted text-sm"><b>Cargo: </b> {{ $personal->cargo }} </p>--}}
                        {{--<ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> Cédula de Identidad: <b><br>{{ formatoMillares($personal->cedula, 0) }}</b></li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Ubicación Administrativa: <b><br>{{ $personal->ubicacion_administrativa }}</b></li>
                            <br>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user-alt"></i></span> Estatus: <b>{{ $personal->estatus }}</b></li>
                        </ul>--}}
                    </div>
                    {{--<div class="col-5 text-center">
                        <img src="{{ asset('img/personal/19160501.jpg') }}" alt="user-avatar" class="img-circle img-fluid">
                    </div>--}}
                </div>
            </div>
            <div class="card-footer">
                <div class="text-left user-block">
                    <img src="{{ asset('img/logo_gobernacion.png') }}" class="img-thumbnail" alt="Logo Gobernacion Guarico">
                    <img src="{{ asset('img/alguarisa_logo_original.jpg') }}" class="img-thumbnail" alt="Logo Alguarisa">
                </div>
                <div class="text-right">
                    <a href="tel:04144453149" class="btn btn-sm bg-teal">
                        <i class="fas fa-phone-alt"></i> | Oficina de RRHH
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
