@extends('layouts.admin.master')

@section('title', 'Usuarios')

@section('header', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item active">Usuarios Registrados</li>
    {{--<li class="breadcrumb-item"><a href="#">Nuevo Usuario</a></li>--}}
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
            @if (leerJson(Auth::user()->permisos, 'usuarios.store') || Auth::user()->role == 100)
            <div class="col-md-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h5 class="card-title">Nuevo Usuario</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-user-plus"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => 'usuarios.store', 'method' => 'post']) !!}

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre y Apellido', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Password') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                {!! Form::text('password', $clave, ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Role') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                </div>
                                {!! Form::select('role', role() , null , ['class' => 'custom-select', 'placeholder' => 'Seleccione', 'required']) !!}
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
                            <input type="submit" class="btn btn-block btn-success" value="Guardar">
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Usuarios Registrados</h5>
                        <div class="card-tools">
                            <span class="btn btn-tool"><i class="fas fa-users"></i></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center" data-breakpoints="xs">ID</th>
                                    <th scope="col" class="text-center"><i class="fas fa-cloud"></i></th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" data-breakpoints="xs">Email</th>
                                    <th scope="col" class="text-center" data-breakpoints="xs">Rol</th>
                                    <th scope="col" class="text-center" data-breakpoints="xs">Estatus</th>
                                    <th scope="col" class="text-right" data-breakpoints="xs">Registro</th>
                                    <th scope="col" data-breakpoints="xs" style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row" class="text-center">{{ $user->id }}</th>
                                    <th class="text-center">{!! iconoPlataforma($user->plataforma) !!}</th>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ strtolower($user->email) }}</td>
                                    <td class="text-center">{{ role($user->role) }}</td>
                                    <td class="text-center">{!! status($user->status) !!}</td>
                                    <td class="text-right">{{ haceCuanto($user->created_at)  }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.show') || Auth::user()->role == 100)
                                            <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (leerJson(Auth::user()->permisos, 'usuarios.edit') || Auth::user()->role == 100)
                                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-cogs"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row justify-content-end p-3">
                            <div class="col-md-3">
                                <span>
                                {{ $users->render() }}
                                </span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
