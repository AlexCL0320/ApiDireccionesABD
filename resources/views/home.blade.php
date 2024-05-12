@extends('layouts.app')

    @php
        use App\Models\User;
        use Spatie\Permission\Models\Role;
        use App\Models\Estado;
        use App\Models\Municipio;
        use App\Models\Colonia;
        use App\Models\Direccion;
        use App\Models\CodigoPostal;
        $cant_usuarios = User::count(); 
        $cant_estados = Estado::count();
        $cant_municipios = Municipio::count();
        $cant_colonias = Colonia::count();
        $cant_direcciones = Direccion::count();       
        $cant_codigos_postales = CodigoPostal::count();                                        
    @endphp     

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 style="color: black;" class="page__heading">INICIO</h3>
        </div>
        <div class="section-body" id="contenido_main">
            <div class="row">
                <div class="col-lg-3 col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                <div class="col-lg-3 col-lg-12">
                                        <div class="row display:flex;">
                                            @can('registrar-direcciones')
                                                <div class="col-md-4 col-xl-4">
                                                    <a href="/direcciones" style="text-decoration: none;">
                                                        <div class="card bg-#E0E0E0 order-card mb-4" style="background-color: #E0E0E0">
                                                            <div class="card-block">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('img/iconos_side_bar/direccion.png') }}" alt="icono_usuario2" width="90" height="80" class="mr-3">
                                                                    <h5 class="m-0" style="color: black;">Direcciones</h5>
                                                                    <h5  style="margin-top: 20%; margin-bottom: 0%; color:black"class="ml-auto">{{$cant_direcciones}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endcan


                                            @can('ver-estados')
                                                <div class="col-md-4 col-xl-4">
                                                    <a href="/estados" style="text-decoration: none;">
                                                        <div class="card bg-#E0E0E0 order-card mb-4" style="background-color: #E0E0E0">
                                                            <div class="card-block">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('img/iconos_side_bar/estados.png') }}" alt="icono_usuario2" width="100" height="80" class="mr-3">
                                                                    <h5 class="m-0" style="color: black;">Estados</h5>
                                                                    <h5  style="margin-top: 20%; margin-bottom: 0%; color:black"class="ml-auto">{{$cant_estados}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can('ver-municipios')
                                                <div class="col-md-4 col-xl-4">
                                                    <a href="/municipios" style="text-decoration: none;">
                                                        <div class="card bg-#E0E0E0 order-card mb-4" style="background-color: #E0E0E0">
                                                            <div class="card-block">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('img/iconos_side_bar/municipios.png') }}" alt="roles" width="90" height="90" class="mr-3">
                                                                    <h5 class="m-0" style="color: black;">Municipios</h5>
                                                                    <h5  style="margin-top: 20%; margin-bottom: 0%; color:black"class="ml-auto">{{$cant_municipios}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endcan

                                            @can('ver-colonias')
                                                <div class="col-md-4 col-xl-4">
                                                    <a href="/colonias" style="text-decoration: none;">
                                                        <div class="card bg-#E0E0E0 order-card mb-4" style="background-color: #E0E0E0">
                                                            <div class="card-block">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('img/iconos_side_bar/colonias.png') }}" alt="icono_usuario2" width="90" height="90" class="mr-3">
                                                                    <h5 class="m-0" style="color: black;">Colonias</h5>                                                                    <h5  style="margin-top: 20%; margin-bottom: 0%; color:black"class="ml-auto">{{$cant_colonias}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endcan
                                        </div>                        
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

