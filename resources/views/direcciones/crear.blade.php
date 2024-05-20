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
        <div class="card">
            <div class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
                <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Nueva Direccion</p></strong>
            </div>
            <div style="background-color: #F4F6F9; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
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
                            <!-- Campo oculto para incluir el valor de $user->id -->
                            {!! Form::hidden('user_id', $user->id) !!}
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="d-flex align-items-center" style="margin-top: -1%">
                                        <div>
                                        <label style="color:black; font-family: nunito; font-size: 13.5px" for="cp_lbl">Estado</label><span class="required text-danger">*</span>
                                            {!! Form::text('estado', null, ['class' => 'form-control', 'readonly', 'id' => 'estado', 'maxlength' => 5, 'oninput' => 'limitInputLength(this, 5)', 'style' => 'width: 120%;']) !!}
                                        </div>
                                        <div style="margin-left: 5%;">
                                            <label style="color:black; font-family: nunito; font-size: 13.5px">Municipio</label><span class="required text-danger">*</span>
                                            {!! Form::text('municipio', null, ['class' => 'form-control', 'readonly', 'id' => 'municipio', 'maxlength' => 5, 'oninput' => 'limitInputLength(this, 5)', 'style' => 'width: 220%;']) !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div >
                                        <label style="color:black; font-family: nunito; font-size: 13.5px" for="nombre">Colonia</label><span class="required text-danger">*</span>
                                        <select style="width: 50%; margin-right: 5%; margin-top:0%" id="colonia" class="form-control" name="colonia_id" onchange="imprimirValor(this)">    
                                            <option value="0">----Selecciona Colonia----</option>
                                        </select>
                                    </div>     
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
        </div>
        </div>
</section>
@endsection

<!--Script para  validar la entrada maxima del codigo postal-->
<script>
    var respuestaExitosa = false

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
            respuestaExitosa =true;
            // Verificar si hay datos en la respuesta para rellenar el estado y municipio
            if (response.length > 0) {
                var data = response[0][0]; // Obtener el primer elemento del primer array

                // Rellenar los campos de Estado y Municipio con los datos recibidos
                $('#estado').val(data.n_e);
                $('#municipio').val(data.n_m);
            }

            // Limpiar el desplegable de colonia
            $('#colonia').empty();
            // Verificar si hay datos en la respuesta para rellenar las colonias
            if (response.length > 0) {
                // Iterar sobre todas las opciones del array
                response.forEach(function(colonias) {
                    // Iterar sobre las colonias y agregarlas al desplegable
                    colonias.forEach(function(colonia) {
                        $('#colonia').append($('<option>', {
                            value: colonia.i_c,
                            text: colonia.n_c
                        }));
                    });
                });
                
            //Bloqueamos el registro del cp y el select de colonias
            //$('#cp').prop('disabled', true);
            //$('#colonia').prop('disabled', true);

            }

        },
        error: function(xhr, status, error) {
            console.error('Error al buscar datos:', error);
            console.error(xhr.responseText); // Imprime la respuesta del servidor
            // Mostrar un alert para avisar que no se econtro la colonia o el codigo es invalido
            alert('Código postal no encontrado');
            respuestaExitosa=false;
            // Limpiar los campos de estado, municipio y colonia si no se encuentra es CP
            $('#estado').val('');
            $('#municipio').val('');
            $('#colonia').empty();
        }
        });
    }

    function imprimirValor(){
        // Evento que se activa cuando cambia la selección en el desplegable
        $('#colonia').change(function() {
            // Obtener el valor seleccionado
            var selectedValue = $(this).val();
            // Imprimir el valor en la consola
            console.log('Valor seleccionado:', selectedValue);
           });
        }
</script>
