@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inicio Rapido</h3>
        </div>
        <div class="section-body" id="contenido_main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                    <div class="col-md-4 col-xl-4">
                                    <div class="card bg-#268196 order-card" style="background-color: #268196">
                                            <div class="card-block">
                                            <h5 class="text-dark">Usuarios</h5>                                             
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-success order-card">
                                            <div class="card-block">
                                            <h5>Roles</h5>                                               
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>                                                                
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-warning order-card">
                                            <div class="card-block">
                                                <h5>Direcciones</h5>                                               
                                                @php
                                                 use App\Models\Direccion;
                                                 //use App\Models\Blog;
                                                 //$cant_blogs = Blog::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/direcciones" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-danger order-card">
                                            <div class="card-block">
                                                <h5>Estados</h5>                                               
                                                @php
                                                use App\Models\Estado;
                                                $cant_estados = Estado::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-map-marked-alt f-left"></i><span>{{$cant_estados}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-dark order-card">
                                            <div class="card-block">
                                                <h5>Municipios</h5>                                               
                                                @php
                                                 use App\Models\Municipio;
                                                $cant_municipios = Municipio::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-landmark f-left"></i><span>{{$cant_municipios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/municipios" class="text-white">Ver más</a></p>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-#457766 order-card" style="background-color: #457766;">
                                            <div class="card-block">
                                                <h5>Colonias</h5>                                               
                                                @php
                                                 use App\Models\Colonia;
                                                //$cant_blogs = Blog::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-4 col-xl-4">
                                        <div class="card bg-#EF4F90 order-card" style="background-color: #EF4F90">
                                            <div class="card-block">
                                                <h5>Codigos Postales</h5>                                               
                                                @php
                                                 use App\Models\CodigoPostal;
                                                //$cant_blogs = Blog::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                        </div>  

                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

