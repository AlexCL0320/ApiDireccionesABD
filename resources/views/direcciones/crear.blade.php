@extends('layouts.app')
<style>
    .uppercase-input {
    text-transform: uppercase;
}
</style>
@section('content')
<section class="section">
        <div class="section-header">
        <a href="">
        <h3 style="color: black;" class="page__heading">Registrar Direccion</h3>
        </a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <label class="text-danger">Los campos con * son obligatorios</label>
                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::open(array('route' => 'direcciones.store','method'=>'POST')) !!}
                        <!-- Otros campos del formulario -->
                        
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label><span class="required text-danger">*</span>
                                    {!! Form::text('nombre', $user->nombre, array('class' => 'form-control uppercase-input', 'readonly')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="a_p_lbl">Apellido Paterno</label><span class="required text-danger">*</span>
                                    {!! Form::text('apellido_p', $user->apellido_p, array('class' => 'form-control uppercase-input', 'readonly')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="a_m_lbl">Apellido Materno</label><span class="required text-danger"></span>
                                    {!! Form::text('apellido_m', $user->apellido_m, array('class' => 'form-control uppercase-input','readonly')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cp_lbl">Código Postal</label><span class="required text-danger">*</span>
                                    {!! Form::text('codigo_postal', null, ['class' => 'form-control', 'id' => 'cp', 'maxlength' => 5, 'oninput' => 'limitInputLength(this, 5)']) !!}
                                </div>
                            </div>

                            <div class="d-flex align-items-center" >
                                <div class="d-flex align-items-center" style= "margin-left: 3%; margin-bottom: 15%" >
                                    <label for="nombre">Estado</label><span class="required text-danger">*</span>
                                    <label style= "margin-left: 208%;"for="nombre">Municipio</label><span class="required text-danger">*</span>
                                </div>
                                    <select style="width: 50%; margin-left: -20.5%; margin-right: 5%; margin-top:0%" id="estado" class="form-control" onchange="filtro_estados(this); filtro_estado(this)">    
                                        <option value="">----Selecciona Estado----</option>
                                    </select>
                                    <select style="width: 50%; margin-top:0%" id="municipio" class="form-control" onchange="filtro_municipio(this)">
                                        <option value="">----Selecciona Municipio----</option>
                                    </select>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="calle_lbl">Calle</label><span class="required text-danger">*</span>
                                    {!! Form::text('calle', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="n_e_lbl">No. Exterior</label><span class="required text-danger">*</span>
                                    {!! Form::number('numero_ex', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="n_i_lbl">No. Interior</label>
                                    {!! Form::number('numero_int', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>
                        </div>
                            <div style="margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12">
                                <button style="background-color: #326565; color:white" type="submit" class="btn">Guardar</button>
                                <a href="/direcciones" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                        
                        
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

<!--Script para  validar la entrada maxima del codigo postal-->
<script>
    function limitInputLength(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
        if (element.value.length === maxLength) {
            buscarDatos(element.value);
        }
    }

    function buscarDatos(codigoPostal) {
        // Realizar una petición AJAX al controlador ColoniasController
        $.ajax({
            url: '{{ route('colonias.buscar_datos') }}', // Usar el nombre de la ruta
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                codigo_postal: codigoPostal
            },
            success: function(response) {
                console.log('Datos recibidos:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error al buscar datos:', error);
                console.error(xhr.responseText); // Imprime la respuesta del servidor
            }
        });
    }
</script>
