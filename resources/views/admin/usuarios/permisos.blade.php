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
                                <img class="img-circle img-bordered-sm" src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="user image">
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
                @include('admin.usuarios.permisos.dashboard')
                @include('admin.usuarios.permisos.modulo_usuarios')
                @else
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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn_crear_usuario = document.getElementById('optionUsuarios1');
            var btn_usuarios_store = document.getElementById('optionUsuariosp1');
            btn_crear_usuario.addEventListener('click', function () {
               btn_usuarios_store.click();
            });
        });
    </script>
@endsection
