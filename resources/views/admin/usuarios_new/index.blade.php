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
    <script>
        console.log('Hi!');
        $('.swalDefaultInfo').click(function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: 'Generando Excel...',
                didOpen: () => {
                    Swal.showLoading()
                },
                showConfirmButton: false,
                timer: 3000,
            });
        });
    </script>
@endsection

@section('content')
    @livewire('usuarios-component')


@endsection
