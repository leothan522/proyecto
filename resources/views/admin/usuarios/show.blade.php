@extends('layouts.admin.master')

@section('title', 'Usuarios')

@section('header', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios Registrados</a></li>
    <li class="breadcrumb-item active">Ver Usuarios</li>
@endsection

@section('link')
    <!-- Datatables -->
    <link href="{{ asset('plugins/footable/css/footable.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('plugins/footable/js/footable.min.js') }}"></script>
    <script>
        jQuery(function ($) {
            $('.table').footable();
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user.png') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">{!! iconoPlataforma($user->plataforma) !!}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Rol</b> <a class="float-right">{{ role($user->role) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Estatus</b> <a class="float-right text-danger">{!! status($user->status) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Registro</b> <a class="float-right">{{ haceCuanto($user->created_at) }}</a>
                            </li>
                        </ul>

                        {!! Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}
                        <input type="hidden" name="mod" value="status">
                        @if ((leerJson(Auth::user()->permisos, 'usuarios.status') &&
                            ($user->id != Auth::user()->id) ||
                            Auth::user()->role == 100))
                            @if ($user->status > 0)
                                <button type="submit" class="btn btn-danger btn-block"><b>Suspender Usuario</b></button>
                            @else
                                <button type="submit" class="btn btn-success btn-block"><b>Activar Usuario</b></button>
                            @endif
                        @endif

                        {!! Form::close() !!}


                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @if (leerJson(Auth::user()->permisos, 'usuarios.editar') || Auth::user()->role == 100)
            <div class="col-md-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Editar Usuario</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-user-edit"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}
                        @if ($user->plataforma == 0)
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre y Apellido', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
                                </div>
                            </div>
                        @endif
                        @if ($user->role != 100 && $user->id != Auth::user()->id)
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Role') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                    </div>
                                    {!! Form::select('role', role() , $user->role, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="role" value="{{ $user->role }}">
                        @endif
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
                            <input type="hidden" name="mod" value="datos">
                            @if ($user->role != 100 || Auth::user()->role == 100)
                                @if ($user->status != 0)
                                    <input type="submit" class="btn btn-block btn-primary" value="Guardar Cambios">
                                    @else
                                    <input type="button" class="btn btn-block btn-primary disabled" value="Guardar Cambios">
                                @endif
                            @endif

                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            @endif
            @if (leerJson(Auth::user()->permisos, 'usuarios.clave') || Auth::user()->role == 100)
            <div class="col-md-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Seguridad</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}

                        @if (session('nueva_clave'))
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('New Password') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <label for="nueva_clave" class="form-control">{{ session('nueva_clave') }}</label>
                                </div>
                            </div>
                        @endif

                        <div class="form-group text-right">
                            @if ($user->status != 0 && $user->role != 100)
                                <input name="mod" type="hidden" value="clave">
                                <input type="submit" class="btn btn-block btn-secondary" value="Restablecer Contraseña">
                            @else
                                <input type="button" class="btn btn-block btn-secondary disabled" value="Restablecer Contraseña">
                            @endif

                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection
