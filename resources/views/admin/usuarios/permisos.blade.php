@extends('layouts.admin.master')

@section('title', 'Usuarios')

@section('header', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios Registrados</a></li>
    <li class="breadcrumb-item active">Permisos de Usuarios</li>
@endsection

{{--@section('nav-a')
    @if (leerJson(Auth::user()->permisos, 'admin.dashboard'))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
        </li>
    @endif

@endsection--}}

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-4 text-center">
                @include('flash::message')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="user-block">
                            <a href="#" data-toggle="modal" data-target="#modal-default">
                                <img class="img-circle img-bordered-sm" src="{{ asset('img/user.png') }}" alt="user image">
                            </a>
                            <span class="username">
                                <a href="#">{{ ucwords($user->name) }}</a>
                            </span>
                            <span class="description">
                                {{ $user->email }}
                                <strong>({{ role($user->role) }})</strong>
                            </span>
                        </div>
                        <div class="card-tools">
                            <span class="btn btn-tool">ID: {{ $user->id }}</span>
                           {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::open(['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}
        <div class="row justify-content-center">
            @if ($user->role > 0)

                <div class="col-md-3">
                    <!-- @include('admin.usuarios.permisos.dashboard') -->
                    <label class="col-md-12">Configuración</label>
                    @include('admin.usuarios.permisos.modulo_usuarios')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12">Parametros</label>
                    @include('admin.usuarios.permisos.modulo_municipios')
                    @include('admin.usuarios.permisos.modulo_parroquias')
                    @include('admin.usuarios.permisos.modulo_familias')
                    @include('admin.usuarios.permisos.modulo_bloques')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12">Gestionar Bloques</label>
                    @include('admin.usuarios.permisos.modulo_consultar_bloques')
                    @include('admin.usuarios.permisos.modulo_periodo')
                </div>
                <div class="col-md-3">
                    <label class="col-md-12">Modulo CLAPS</label>
                    @include('admin.usuarios.permisos.modulo_consultar_claps')
					<label class="col-md-12">Programas</label>
                    @include('admin.usuarios.permisos.modulo_programas')
                </div>
                @else
                {{-- Usuarios Estandar --}}
                @include('admin.usuarios.permisos.blanco')
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <input type="hidden" name="mod" value="permisos">
                <button type="submit" class="btn btn-block btn-primary">Guardar Permisos</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="row justify-content-center">
            <div class="col-md-9 text-right p-3">
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver</a>
            </div>
        </div>
    </div>


@endsection
