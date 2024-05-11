<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373;" class="nav-link" href="/home">
        <i class=" fab fa-bandcamp"></i><span>Inicio</span>
    </a>
    @can('ver-usuario')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan
    @can('registrar-direccion')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/roles">
        <i class="fas fa-book"></i><span>Direcciones</span>
    </a>
    @endcan
    @can('ver-Estados')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/estados">
        <i class="fas fa-map-marked-alt"></i><span>Estados</span>
    </a>
    @endcan
    @can('ver-Municipios')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/municipios">
        <i class="fas fa-landmark"></i><span>Municipios</span>
    </a>
    @endcan
    @can('ver-Colonias')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/colonias">
        <i class=" fas fa-blog"></i><span>Colonias</span>
    </a>
    @endcan
    @can('ver-CP')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/escuelas">
        <i class=" fas fa-blog"></i><span>Codigos Postales</span>
    </a>
    @endcan
    @can('ver-CP')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/escuelas">
        <i class=" fas fa-blog"></i><span>Codigos Postales</span>
    </a>
    @endcan
    @can('ver-CP')
    <a style="background-color: #5A5A5A; color: white; border: 1px solid #737373" class="nav-link" href="/escuelas">
        <i class=" fas fa-blog"></i><span>Codigos Postales</span>
    </a>
    @endcan


</li>
