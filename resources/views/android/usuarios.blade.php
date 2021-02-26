@extends("layouts.android.master")

@section('content')

    <div class="col-md-12">
        @foreach ($usuarios as $usuario)
            <div class="card">
                <div class="card-header">
                    <div class="user-block">
                        <a href="#" data-toggle="modal" data-target="#exampleModal-{{ $usuario->id }}">
                            @if($usuario->plataforma == 0)
                                <img class="{{--img-circle--}} {{--img-bordered-sm--}}" src="{{ asset('img/iconos_material/baseline_desktop_windows_black_48dp.png') }}" alt="user image">
                            @else
                                <img class="{{--img-circle--}} {{--img-bordered-sm--}}" src="{{ asset('img/iconos_material/baseline_phone_android_black_48dp.png') }}" alt="user image">
                            @endif
                        </a>
                        <span class="username">
                            <a href="#" data-toggle="modal" data-target="#exampleModal-{{ $usuario->id }}">{{ $usuario->name }}</a>
                        </span>
                        <span class="description"><small>{{ $usuario->email }}</small></span>
                    </div>
                    <div class="card-tools">
                        <span class="btn btn-tool">{{ $usuario->id }}</span>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal-{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                    <div class="modal-content">
                        {{--<div class="modal-header">
                            --}}{{--<h4 class="modal-title">Default Modal</h4>--}}{{--
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>--}}
                        <div class="modal-body">




                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user.png') }}" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{ $usuario->name }}</h3>

                                    <p class="text-muted text-center">{{ $usuario->email }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Plataforma</b>
                                            @if($usuario->plataforma == 0)
                                                <a class="float-right"><i class="fa fa-desktop"></i></a>
                                            @else
                                                <a class="float-right"><i class="fa fa-mobile-alt"></i></a>
                                            @endif

                                        </li>
                                        <li class="list-group-item">
                                            <b>Teléfono</b> <a class="float-right">{{ $usuario->two_factor_secret }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Registrado</b> <a class="float-right">{{ $carbon->parse($usuario->created_at)->diffForHumans() }}</a>
                                        </li>
                                    </ul>

                                    {{--<a href="#" class="btn btn-primary btn-block" data-dismiss="modal"><b>Follow</b></a>--}}
                                    <a href="#" class="btn btn-default btn-block" data-dismiss="modal"><b>Cerrar</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>



                        </div>
                        {{--<div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>--}}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        @endforeach
    </div>
    <div class="col-md-12 text-center">
        {{ $usuarios->render() }}
    </div>


@endsection
