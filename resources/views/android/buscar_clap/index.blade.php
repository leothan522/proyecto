@extends("layouts.android.master")

@section('content')

    <div class="row mb-12 justify-content-center">
        {!! Form::open(['route' => ['android.modulo_clap_buscar', Auth::user()->id], 'method' => 'POST']) !!}
        <div class="input-group">
            <input type="text" name="buscar" placeholder="Buscar Cédula" class="form-control" required>
            <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-flat" onclick="verCargando()"><i class="fa fa-search"></i></button>
                </span>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
