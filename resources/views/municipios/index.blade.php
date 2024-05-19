@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 style="color:black" class="page__heading">Municipios</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div  class="card">
              <div  class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
              <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Filtros de Busqueda</p></strong>
              </div>
              <div style="background-color: #F4F6F9; height: 120px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <!-- Elementos de filtrado-->
                    <b><label style="font-family: Nunito; font-size: 13.5px; color:black" for="estado">Estado</label></b>
                    <div class="d-flex align-items-center">
                    <select style="width: 20%; background-color: #CC0033; color: white; border-color: #CC0033;  " id="estado" class="form-control" onchange="filtro_estado(this)">
                      <option value="">----Selecciona estado----</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nombre}}
                      </option>
                      @endforeach
                    </select>
                    <a style="background-color: #457766; font-size: 13.5; font-family: nunito; color: white; margin-left: 31.3%; width: 15.8%" class="btn" href="{{ route('municipios.index') }}" title="Todos">Limpiar</a>
                    </div>
                    <div><br></div>
                    <script>
                    // Imprimir el JSON de municipios en la consola
                    console.log(@json($municipios));
                    </script>
                  </div>
                </div>
              </div>
            </div>  
                     <!-- Creamos la tabla para mostrar los municipios -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead style="background-color:#326F8A">
                 <tr>
                  <th style="color: white; width: 20%">No. Municipio</th>
                  <th style="color: white; width: 50%">Nombre</th>
                  <th style="color: white; width: 20%;">Estado</th>
                  <th style="color: white; width: 10%;">Ubicacion</th>
                </tr>
              </thead>
              <tbody id="tablaBody">
                <!-- Iteramos sobre los municipios y los mostramos en la tabla -->
                @foreach ($municipios as $municipio)
                <tr>
                  <td>{{ $municipio->no }}</td>
                  <td>{{ $municipio->n_m }}</td>
                  <td>{{ $municipio->n_e }}</td>
                  <!--Agregamos el enlace para la ubicacion de los munnicipios en el Mapa--->
                  <td>
                    <a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn"  href="{{ $municipio->u }}" title="Ubicación"  target="_blank">
                    <img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!--Script para filtrar los elementos de la tabla en base al desplegable #estado-->
<script>
  function filtro_estado() {
    // Obtener el ID del estado seleccionado
    var estado_id = $('#estado').val();
    console.log(estado_id);
    // Realizar una petición AJAX para obtener los datos filtrados
    $.ajax({
        //Llamos al metodo del controlador y le paso el id del estado seleccionado
        url: '/municipios/filtro_municipio/' + estado_id, 
        method: 'POST',
        data: { id: estado_id, _token: '{{ csrf_token() }}' }, // Datos a enviar al controlador
        //Rellana la tabla al obtener una respuesta del controlador
        success: function(response) {
            // Limpiar la tabla
            $('#miTabla tbody').empty();
            $i = 0; //Contador de los elementos filtrados
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            $.each(response, function(index, municipio) {
                var row = '<tr>' +
                    '<td>' + municipio.no + '</td>' +
                    '<td>' + municipio.n_m + '</td>' +
                    '<td>' + municipio.n_e + '</td>' +
                    '<td>' +
                    '<a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn" href="' + municipio.u + '" title="Ubicación" target="_blank">' +
                    '<img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">' +
                    '</a>' +
                    '</td>' +
                    '</tr>';
                $('#miTabla tbody').append(row); //Agregamos el registro a las filas de la tabla
                $i++;
            }); 
            console.log($i);//Imprimimos el contador en consola para saber los municipios filtrados
            // Actualizar la configuración de la paginación - Aun no funciona como deberia
            var newTotalRecords = $i; // Número total de registros después del filtro
            $('#miTabla').DataTable().settings()[0]._iRecordsTotal = newTotalRecords;
            $('#miTabla').DataTable().settings()[0]._iRecordsDisplay = newTotalRecords;
            $('#miTabla').DataTable().draw(); // Redibujar la tabla con la nueva configuración de paginación

            // Destruimos la instancia existente del DataTable y la reinstalamos para reflejar los nuevos datos
            $('#miTabla').DataTable().destroy();
            $('#miTabla').DataTable();

        },
        //Si ocurre algun error al obtener los municipios pertenecientes a un estado lo imprimimos por consola
        error: function(xhr, status, error) {
            console.error('Error al obtener datos:', error);
        }
    });
}
</script>


<script>
  // Inicializamos el DataTable en la tabla y su paginacion
  $('#miTabla').DataTable({
    lengthMenu: [
      [100, 200, 400], //Opciones de paginacion del desplegable
      [100, 200, 400] //Paginacion de la tabla
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
    // Desactivamos la ordenación inicial del DataTable
    "order": []
  });
</script>
@endsection