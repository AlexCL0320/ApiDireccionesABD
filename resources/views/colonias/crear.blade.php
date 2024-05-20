@extends('layouts.app')

@section('content')
    <head>
        <style>
        #segundoFormulario {
            display: none; /* Oculta el formulario dos*/
        }
        </style>
    </head>
    <section class="section">
        <div class="section-header">
            <h3 style="color:black" class="page__heading">Alta de colonias</h3>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
                    <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Colonia Origen</p></strong>
                </div>
                <div style="background-color: #F4F6F9; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
                    <div class="row">      
                        <div class="col-lg-12">
                            <label class="text-danger">Los campos con * son obligatorios</label>
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>¡Los campos</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>son obligatorios, reinicia registro!</strong>
                                
                                </div>
                            @endif
                    
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">    
                                    <div class="form-group">
                                        <label for="cp_lbl">Código Postal</label><span class="required text-danger">*</span>
                                        {!! Form::text('codigo_postal', null, ['class' => 'form-control', 'id' => 'cp', 'maxlength' => 5, 'oninput' => 'limitInputLength(this, 5)', 'style' => 'width: 20%;']) !!}
                                    </div>
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
                                        <select style="width: 50%; margin-right: 5%; margin-top:0%" id="colonia" class="form-control" onchange="filtro_estados(this); filtro_estado(this)">    
                                            <option value="0">----Selecciona Colonia----</option>
                                        </select>
                                    </div>                                                                </div>
                                <div style="margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12">
                                    <button style="background-color: #326565; color:white" class="btn" id="siguiente" onclick="mostrarSegundoFormulario()">Siguiente</button>
                                    <a href="/colonias" class="btn btn-danger" id="cancelar1">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>

            <!--Formulario de registro para la nueva colonia -->
            <div id="segundoFormulario" class="card">
                <div class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
                    <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Colonia Nueva</p></strong>
                </div>
                <div style="background-color: #F4F6F9; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
                    <div class="row">      
                        <div class="col-lg-12">
                        <label class="text-danger">Los campos con * son obligatorios</label>
                        {!! Form::open(array('route' => 'colonias.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label><span class="required text-danger">*</span>
                                    {!! Form::text('nombre_col', null, array('class' => 'form-control', 'id' => 'nombre')) !!}
                                </div>
                                <div class="form-group">
                                        <label for="cp_lbl">Código Postal</label><span class="required text-danger">*</span>
                                        {!! Form::text('codigo_postal_col', null, ['class' => 'form-control', 'readonly', 'id' => 'cp2', 'style' => 'width: 20%;']) !!}
                                    </div>
                                    <div class="d-flex align-items-center" style="margin-top: -1%">
                                        <div>
                                        <label style="color:black; font-family: nunito; font-size: 13.5px" for="cp_lbl">Estado</label><span class="required text-danger">*</span>
                                            {!! Form::text('estado_col', null, ['class' => 'form-control', 'readonly', 'id' => 'estado2', 'style' => 'width: 120%;']) !!}
                                        </div>
                                        <div style="margin-left: 5%;">
                                            <label style="color:black; font-family: nunito; font-size: 13.5px">Municipio</label><span class="required text-danger">*</span>
                                            {!! Form::text('municipio_col', null, ['class' => 'form-control', 'readonly', 'id' => 'municipio2', 'style' => 'width: 220%;']) !!}
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div style="margin-left: 1.5%;">
                                    <label style="color:black; font-family: nunito; font-size: 13.5px" for="nombre">Colonia Origen</label><span class="required text-danger">*</span>
                                    <select style="width: 100%; margin-right: 5%; margin-top:0%" id="colonia2" class="form-control">   
                                    </select>
                                </div>
                                <br>
                                <div style="margin-left: 2%;">
                                    <label style="color:black; font-family: nunito; font-size: 13.5px">Ubicacion</label><span class="required text-danger">*</span>
                                    {!! Form::text('ubicacion', null, ['class' => 'form-control', 'id' => 'ubicacion', 'style' => 'width: 260%;']) !!}
                                </div>
                            </div>
                            <div style="margin-left: -1% ;margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12">
                                <button style="background-color: #326565; color:white" type="submit" class="btn">Guardar</button>
                                <a href="/usuarios" class="btn btn-danger">Cancelar</a>
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
                            value: colonia.id_c,
                            text: colonia.n_c
                        }));
                    });
                });
                
                // Mostrar el segundo formulario
                //mostrarSegundoFormulario();
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
</script>
<script>
    function mostrarSegundoFormulario() {
        // Mostrar el segundo formulario solo si la respuesta fue exitosa
        if (respuestaExitosa) {
            $('#segundoFormulario').show();
            //Bloqueamos el registro del cp y el select de colonias
            $('#cp').prop('disabled', true);
            $('#colonia').prop('disabled', true);
            //Desactivamos el boton de cancelar para el primer formulario
            $('#cancelar1').prop('disabled', true);            
            // Manejar click en el enlace Cancelar para prevenir la redirección
            $('#cancelar1').on('click', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
            });

            // Rellenamos los datos de la nueva colonia
            $('#estado2').val($('#estado').val());
            $('#municipio2').val($('#municipio').val());
            $('#cp2').val($('#cp').val());

            // Obtener el valor y texto de la opción seleccionada en el select con id 'colonia'
            var selectedValue = $('#colonia').val();
            var selectedText = $('#colonia option:selected').text();

            // Vaciar el select con id 'colonia2'
            $('#colonia2').empty();

            // Agregar la opción seleccionada al select con id 'colonia2'
            $('#colonia2').append($('<option>', {
                value: selectedValue,
                text: selectedText
            }));
            //Bloqueamos el select
            $('#colonia2').prop('disabled', true);

        }
        else{
            alert('Código postal no encontrado');
        }
    }
</script>
