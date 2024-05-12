<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" href="/home">
    <img src="{{ asset('img/iconos_side_bar/inicio.png') }}" alt="Inicio Icon" style="width: 30px; height: 30px; margin-right: 5px;">
    <span>Inicio</span>
    </a>
    <!--    @can('ver-usuario')
    <a style="background-color: #F4F6F9; color: white; border: 1px solid #737373" class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan-->
    @can('registrar-direccion')
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" href="/direcciones">
    <img src="{{ asset('img/iconos_side_bar/direccion.png') }}" alt="Direcciones Icon" style="width: 30px; height: 30px; margin-right: 5px;">
    <span>Direcciones</span>
    </a>
    @endcan

    @can('ver-estados')
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" href="/estados">
    <img src="{{ asset('img/iconos_side_bar/estados.png') }}" alt="Estados Icon" style="width: 33px; height: 28px; margin-right: 5px;">
    <span>Estados</span>
    </a>
    @endcan

    @can('ver-municipios')
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" href="/municipios">
    <img src="{{ asset('img/iconos_side_bar/municipios.png') }}" alt="Estados Icon" style="width: 40px; height: 35px; margin-right: 5px;">
    <span>Municipios</span>
    </a>
    @endcan

    @can('ver-colonias')
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" href="/colonias">
    <img src="{{ asset('img/iconos_side_bar/colonias.png') }}" alt="Estados Icon" style="width: 40px; height: 30px; margin-right: 5px;">
    <span>Colonias</span>
    </a>
    @endcan
    
    <a style="margin: 10px; max-width: 90%; background-color:#F4F6F9; color: black; border: 1px solid #737373; border-radius: 6px" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <img src="{{ asset('img/iconos_side_bar/salir.png') }}" alt="Inicio Icon" style="width: 30px; height: 30px; margin-right: 5px;">
    <span>Salir</span>
    </a>

</li>
