@extends('layouts.auth_app')
@section('title')
    Register
@endsection
<style>
    .uppercase-input {
    text-transform: uppercase;
}
</style>

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

    <div class="card card-dark">
        <div style="text-align: left; margin-left: 5%;" class="login-message">Registrar Usuario</div>
        <br>

        <div class="card-body pt-1">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Nombre(s):</label><span
                                    class="text-danger">*</span>
                            <input id="firstName" type="text"
                                   class="uppercase-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   tabindex="1" placeholder="" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Apellido Paterno:</label><span
                                    class="text-danger">*</span>
                            <input id="lastName" type="text"
                                class=" uppercase-input form-control{{ $errors->has('apellido_p') ? ' is-invalid' : '' }}"
                                name="apellido_p"
                                tabindex="2" placeholder="" value="{{ old('apellido_p') }}"
                                required>
                            <div class="invalid-feedback">
                                {{ $errors->first('apellido_p') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Apellido Materno:</label><span
                                    class="text-danger">*</span>
                            <input id="lastName" type="text"
                                class="uppercase-input form-control{{ $errors->has('apellido_m') ? ' is-invalid' : '' }}"
                                name="apellido_m"
                                tabindex="3" placeholder="" value="{{ old('apellido_m') }}"
                                required>
                            <div class="invalid-feedback">
                                {{ $errors->first('apellido_m') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo:</label><span
                                    class="text-danger">*</span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Direccion email" name="email" tabindex="4"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="control-label">Contraseña
                                :</label><span
                                    class="text-danger">*</span>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   placeholder="Al menos 8 caracteres" name="password" tabindex="6" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="control-label">Confirma Contraseña:</label><span
                                    class="text-danger">*</span>
                            <input id="password_confirmation" type="password" placeholder=""
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   name="password_confirmation" tabindex="2">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="custom-btn btn-lg btn-block" tabindex="4">
                                     <div class="form-text">Registrar</div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        ¿Ya tienes una cuenta? <a
                href="{{ route('login') }}">Iniciar Sesión</a>
    </div>
    <div style="margin-bottom: 15%;"></div>
@endsection
