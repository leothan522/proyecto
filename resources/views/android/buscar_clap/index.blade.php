@extends("layouts.android.master")

@section('content')

    <nav class="navbar navbar-expand navbar-white navbar-light justify-content-center" style="border-radius: 10px">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-sm-inline-block">
                <span class="nav-link active text-bold">Cédula</span>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="text" placeholder="Ingrese numero" aria-label="Buscar" required>
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>

    <br>

@endsection
