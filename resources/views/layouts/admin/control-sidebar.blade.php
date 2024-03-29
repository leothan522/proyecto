<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('android.usuarios') }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Usuarios Registrados
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.modulo_clap', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Modulo CLAP
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.ferias_campo', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Ferias del Campo Soberaro
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.plan_proteico', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Plan Proteico
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.tienda_fisica', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Tienda Fisica
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.tienda_enlinea', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Tienda en Linea
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.tienda_movil', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Tienda Movil
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.buscarClap', Auth::user()->id) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Buscar
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('android.personal_alguarisa', 19160501) }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Carnet
            </a>
        </li>
        <li class="dropdown-divider"></li>
    </ul>

</div>
