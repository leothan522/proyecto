@extends("layouts.android.master")

@section('content')

    <div class="col-md-12">
        @foreach ($users as $user)
            <div class="card">
                <div class="card-header">
                    <div class="user-block">
                        <a href="#" data-toggle="modal" data-target="#modal-default">
                            <img class="img-circle img-bordered-sm" src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="user image">
                        </a>
                        <span class="username">
                            <a href="#" data-toggle="modal" data-target="#modal-default">{{ $user->name }}</a>
                        </span>
                        <span class="description">{{ $user->email }}</span>
                    </div>
                    <div class="card-tools">
                        <span class="btn btn-tool">{{ $user->id }}</span>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-default">
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
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                                    <p class="text-muted text-center">{{ $user->email }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Registrado</b> <a class="float-right">{{ $carbon->parse($user->created_at)->diffForHumans() }}</a>
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
        {{ $users->render() }}
    </div>


@endsection
