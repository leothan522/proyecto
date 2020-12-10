<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2 bg-light" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    @if (Auth::user()->role > 0)
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if (leerJson(Auth::user()->permisos, 'gestionar_claps') || Auth::user()->role == 100)
                <li class="nav-item has-treeview lko-claps.get_import lko-claps.index {{--menu-open--}}">
                    <a href="#" class="nav-link lkm-claps.get_import lkm-claps.index">
                        <i class="nav-icon fas fa-clone"></i>
                        <p>
                            Gestionar CLAPS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (leerJson(Auth::user()->permisos, 'claps.index') || Auth::user()->role == 100)
                            <li class="nav-item">
                                <a href="{{ route('claps.index') }}" class="nav-link lk-claps.index">
                                    <i class="fa fa-list-alt nav-icon"></i>
                                    <p>Consultar</p>
                                </a>
                            </li>
                        @endif
                        @if (leerJson(Auth::user()->permisos, 'claps.get_import') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('claps.get_import') }}" class="nav-link lk-claps.get_import">
                                <i class="fa fa-cloud-upload-alt nav-icon"></i>
                                <p>Importar</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (leerJson(Auth::user()->permisos, 'gestionar_bloques') || Auth::user()->role == 100)
                <li class="nav-item has-treeview lko-bloques.consultar {{--menu-open--}}">
                <a href="#" class="nav-link lkm-bloques.consultar">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Gestionar Bloques
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (leerJson(Auth::user()->permisos, 'bloques.consultar') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('bloques.consultar') }}" class="nav-link lk-bloques.consultar">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar Bloques</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link lk-">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mover CLAPS</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (leerJson(Auth::user()->permisos, 'parametros') || Auth::user()->role == 100)
                <li class="nav-item has-treeview lko-municipios.index lko-parroquias.index lko-familias.index lko-bloques.index{{--menu-open--}}">
                <a href="#" class="nav-link lkm-municipios.index lkm-parroquias.index lkm-familias.index lkm-bloques.index">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Parametros
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (leerJson(Auth::user()->permisos, 'municipios.index') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('municipios.index') }}" class="nav-link lk-municipios.index">
                                <i class="fas fa-tag nav-icon"></i>
                                <p>Municipios</p>
                            </a>
                        </li>
                    @endif
                    @if (leerJson(Auth::user()->permisos, 'parroquias.index') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('parroquias.index') }}" class="nav-link lk-parroquias.index">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Parroquias</p>
                            </a>
                        </li>
                    @endif
                    @if (leerJson(Auth::user()->permisos, 'bloques.index') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('bloques.index') }}" class="nav-link lk-bloques.index">
                                <i class="fas fa-cubes nav-icon"></i>
                                <p>Bloques</p>
                            </a>
                        </li>
                    @endif
                    @if (leerJson(Auth::user()->permisos, 'familias.index') || Auth::user()->role == 100)
                        <li class="nav-item">
                            <a href="{{ route('familias.index') }}" class="nav-link lk-familias.index">
                                <i class="fas fa-child nav-icon"></i>
                                <p>Familias</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif
            @if (leerJson(Auth::user()->permisos, 'configuracion') || Auth::user()->role == 100)
                <li class="nav-item has-treeview lko-usuarios.index{{--menu-open--}}">
                <a href="#" class="nav-link lkm-usuarios.index">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Configuración
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (leerJson(Auth::user()->permisos, 'usuarios.index') || Auth::user()->role == 100)
                    <li class="nav-item">
                        <a href="{{ route('usuarios.index') }}" class="nav-link lk-usuarios.index">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </nav>
    @endif
    <!-- /.sidebar-menu -->
</div>
