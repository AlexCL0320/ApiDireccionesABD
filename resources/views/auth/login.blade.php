@extends('layouts.auth_app')
@section('title')
    Inicio de Sesion
@endsection
@section('content')
    <style>
            /* Estilos para el texto de inicio de sesión */
        .login-message {
            font-family: 'Nunito', sans-serif; /* Fuente Nunito */
            font-size: 21px; /* Tamaño de letra de 22 */
            color: black; /* Color de texto negro */
            text-align: center; /* Centrado */
            padding: 20px 0px 0px 0px;
        }

        /* Estilos para el texto dentro del formulario */
        .form-text {
            font-size: 15px; /* Tamaño de letra de 20 */
            color: black; /* Color de texto negro */
            font-family: 'Nunito', sans-serif; /* Fuente Nunito */
        }

        /* Estilos para el botón personalizado */
        .custom-btn {
            background-color: #6F9292; /* Color de fondo personalizado */
            border-color: #6F9292; /* Color del borde personalizado */
            box-shadow: none; 
            border: 1px solid transparent;
        }

        /* Estilos para el botón personalizado al pasar el mouse */
        .custom-btn:hover {
            background-color: #326565; /* Color de fondo personalizado al pasar el mouse */
            border-color: #326565; /* Color del borde personalizado al pasar el mouse */
            
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.1); /* offsetX offsetY blurRadius spreadRadius color */
        }


    </style>
    <div class="card card-dark"  style="border-radius: 12px; ">
        <div ><p class="login-message">INICIO DE SESION</p></div>
        <div style="display:flex; justify-content: center; ">
            <img src="{{ asset('img/usuarios.png') }}" alt="logo" width="115">
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group form-text">
                    <!-- <label for="email">Usuario</label>-->
                    <input style="border-color: #009999" aria-describedby="emailHelpBlock" id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           placeholder="Correo" tabindex="1"
                           value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus
                           required>
                           <!--
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>-->
                </div>

                <div class="form-group form-text">
                    <!-- <label for="password" class="control-label">Password</label> -->
                    <input style="border-color: #009999" aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="Contraseña"
                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    
                    <div style="display: flex; justify-content: center; padding: 20px 0px 0px 0px">
                        <div>
                            <a href="{{ route('password.request') }}" >
                            <div ><p class="form-text">¿Olvidaste tu constraseña?</p></div>
                           </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="custom-btn btn-block btn-lg"  tabindex="4">
                        <div class="form-text">Acceder</div>
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
