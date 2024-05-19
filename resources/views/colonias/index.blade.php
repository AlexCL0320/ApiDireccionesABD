@extends('layouts.app')

@section('content')
<!--Estilo de prueba para cambiar el color de fondo de un select al tratrar de elegir una opcion-->
<style>
    select#cp option:hover {
        background-color: black;
        color: white;
    }
</style>

<section class="section">
  <div class="section-header">
      <h3 style="color:black" class="page__heading">Colonias</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Agregamos un enlace para crear un nuevo colonia si el usuario tiene el permiso -->
            @can('crear-colonia')
              <a class="btn btn-warning" href="{{ route('colonias.create') }}" title="Crear nuevo colonia">Agregar colonia</a>            
              <br><br>
            @endcan
            <!-- Elementos de filtrado-->
            <label style="font-family: Nunito; font-size: 13.5px; color:black; margin-right: 21.2%;" for="estado">Estado</label>
            <label style="font-family: Nunito; font-size: 13.5px; color:black" for="estado">Municipio</label>
            <div class="d-flex align-items-center">
                <select style="width: 20%; background-color: #CC0033; color: white; border-color: #CC0033;  margin-right: 5%" id="estado" class="form-control" onchange="filtro_estados(this); filtro_estado(this)">
                  <option value="">----Selecciona Estado----</option>
                  @foreach($estados as $estado)
                      <option value="{{ $estado->id }}">{{ $estado->nombre}}</option>
                  @endforeach
                </select>
                <select style="width: 50%; background-color: #DAA520; color:white; border-color: #DAA520; " id="municipio" class="form-control" onchange="filtro_municipio(this)">
                    <option value="">----Selecciona Municipio----</option>
                </select>
              </div>
              <br>
              <label style="font-family: Nunito; font-size: 13.5px; color:black" for="estado">CP</label>
              <div class="d-flex align-items-center">
                <select style="width: 10%; height: 37px; background-color:#268196; color:white; border-color: #268196; " id="cp" class="form-control" onchange="">
                    <option value="">---CP---</option>
                </select>
                <a style="background-color: #457766; font-size: 13.5; font-family: nunito; width: 10%; margin-left: 3%; color: white;" class="btn" href="{{ route('colonias.index') }}" title="Todos">Limpiar</a>            
              </div>
              <br><br>

            <script>
            // Imprimir el JSON de colonias en la consola
            console.log(@json($colonias));
            </script>

            <!-- Creamos la tabla para mostrar los colonias -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead style="background-color:#326F8A"> <!--Aplicamos un color de fondo de encabezado personalizado-->
                 <tr>                
                  <th style="color: white; width: 2%">No.</th>
                  <th style="color: white; width: 30%">Nombre</th>
                  <th style="color: white; width: 20%">Estado</th>
                  <th style="color: white; width: 20%">Municipio</th>
                  <th style="color: white; width: 15%">CP</th>
                  <th style="color: white; width: 3%">Ubicacion</th>
                  <!--Opciones de edicion para el rol Capturista-->
                  @can('crear-colonia')
                    <th style="color: white; width: 10%">Acciones</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <!-- Iteramos sobre las colonias y los mostramos en la tabla -->
                @foreach ($colonias as $colonia)
                <tr class="estado_{{ $colonia->estado_id }}">
                  <td>{{ $colonia->id }}</td>
                  <td>{{ $colonia->n }}</td>
                  <td>{{ $colonia->n_e }}</td>
                  <td>{{ $colonia->n_m }}</td>
                  <td>{{ $colonia->c }}</td>
                  <!--Agregamos el enlace para la ubicacion de las colonias en el Mapa--->
                  <td>
                    <a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn"  href="{{ $colonia->u }}" title="Ubicación"  target="_blank">
                    <img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">
                    </a>
                  </td>
                  @can('crear-colonia')
                  <!--Opciones de edicion para el rol Capturista-->
                  <td style="padding: 10px">     
                    <a style="background-color: #415A5A; color: white; margin-bottom: 5%;" class="btn" href="{{ route('colonias.edit', $colonia->id) }}" title="Editar colonia">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['colonias.destroy', $colonia->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $colonia->id]) !!}
                    {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $colonia->id . ')']) !!}
                    {!! Form::close() !!}
                    <!--Script para un mensaje de confirmacion sobre un registro-->
                    <script>
                        function confirmarEliminar(id) {
                            if (confirm('¿Estás seguro de eliminar este registro?')) {
                                document.getElementById('deleteForm-' + id).submit();
                                return true;
                            } else {
                                return false;
                            }
                        }
                    </script>
                  </td>
                  @endcan
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

<!-- Script para manipular la actualizacion de los desplegables-->
<script>
  function filtro_estados(estados) {
    //Obtenemos el id seleccionado desde el desplegable
    let estado_id = estados.value;
    //Llamos al metodo obtener_mun del controlador para consultar los municipios del estaado
    fetch('/colonias/obtener_mun/' + estado_id)
      //Recuperamos la variable $municipios de la consulta a la base de datos
      .then(function(response) {
        return response.json();
      })
      //Obtenemos el json de datos de la consulta
      .then(function(jsonData) {
       //console.log(jsonData); 
       consultarMunicipios(jsonData);
      })
      //Recuperamos el tipo de error y lo mostramos en la consola del navegador
      .catch(function(error) {
        console.error('Error al consultar los municipios:', error);
      });
       
      //Funcion para rellenar el desplegable de municipios
      function consultarMunicipios(jsonData){
        //Obtenemos el desplegable de municipios en base a su id
        let municipios = document.getElementById('municipio') 
        //Llamamos a la funcion de limpieza del desplegable para evitar acummular municipios de estados diferentes
        limpiar_mun(municipios);
        //Recorremos el json de datos
        jsonData.forEach(function(mun){
          //Creamos una opcion para el desplegable
          let op_mun = document.createElement('option');
          //Rellenamos con el id del municipio
          op_mun.value = mun.id;
          //Rellenamos con el nombre del municipio
          op_mun.innerHTML = mun.nombre;
          //Agregamos la opcion al desplegable
          municipios.append(op_mun);
        });
      }

      //Funcion para limpiar los elementos previos del select 
      function limpiar_mun(des_mun){
        while(des_mun.options.length >1){
          des_mun.remove(1);
        }
      }
  }
</script>

<!--Script para filtrar los elementos de la tabla en base al desplegable-->
<script>
  function filtro_estado() {
    // Obtener el ID del estado seleccionado
    var estado_id = $('#estado').val();
    console.log(estado_id);

    // Realizar una petición AJAX para obtener los datos filtrados
    $.ajax({
        url: '/colonias/filtro_estado/' + estado_id, // Actualizado para usar la ruta correcta
        method: 'POST',
        data: { id: estado_id, _token: '{{ csrf_token() }}' }, // Datos a enviar al controlador
        success: function(response) {
            // Limpiar la tabla
            $('#miTabla tbody').empty();
            $i = 0;
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            $.each(response, function(index, colonia) {
                var row = '<tr>' +
                    '<td>' + colonia.no + '</td>' +
                    '<td>' + colonia.n + '</td>' +
                    '<td>' + colonia.n_e + '</td>' +
                    '<td>' + colonia.n_m + '</td>' +
                    '<td>' + colonia.c + '</td>'  +
                    '<td>' +
                    '<a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn" href="' + colonia.u + '" title="Ubicación" target="_blank">' +
                    '<img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">' +
                    '</a>' +
                    '</td>' +
                    '@can("crear-colonia")' +
                    '<td style="padding: 10px">' +
                    '<a style="background-color: #415A5A; color: white; margin-bottom: 5%;" class="btn" href="/colonias/' + colonia.id + '/edit" title="Editar colonia">Editar</a>' +
                    '<form method="POST" action="/colonias/' + colonia.id + '" style="display:inline" id="deleteForm-' + colonia.id + '">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<input type="submit" class="btn btn-danger" onclick="return confirmarEliminar(' + colonia.id + ')" value="Borrar">' +
                    '</form>' +
                    '</td>' +
                    '@endcan' +
                    '</tr>';
                $('#miTabla tbody').append(row);
                $i++;
                console.log($i);
            });

            // Actualizar la configuración de la paginación
            var newTotalRecords = $i; // Número total de registros después del filtro
            $('#miTabla').DataTable().settings()[0]._iRecordsTotal = newTotalRecords;
            $('#miTabla').DataTable().settings()[0]._iRecordsDisplay = newTotalRecords;
            $('#miTabla').DataTable().draw(); // Redibujar la tabla con la nueva configuración de paginación
        },

        error: function(xhr, status, error) {
            console.error('Error al obtener datos:', error);
        }
    });
}
</script>

<script>
  function filtro_municipio() {
    // Obtener el ID del estado seleccionado
    var municipio_id = $('#municipio').val();
    var estado_id = $('#estado').val();
    console.log(municipio_id);

    $.ajax({
        url: '/colonias/filtro_municipio/' + municipio_id + '/' + estado_id, // Actualizado para incluir el estado_id en la URL
        method: 'POST',
        data: { id: municipio_id, estado_id: estado_id, _token: '{{ csrf_token() }}' }, // Datos a enviar al controlador
        success: function(response) {
            // Limpiar la tabla
            $('#miTabla tbody').empty();
            $i = 0;
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            $.each(response, function(index, colonia) {
                var row = '<tr>' +
                    '<td>' + colonia.no + '</td>' +
                    '<td>' + colonia.n + '</td>' +
                    '<td>' + colonia.n_e + '</td>' +
                    '<td>' + colonia.n_m + '</td>' +
                    '<td>' + colonia.c + '</td>' +
                    '<td>' +
                    '<a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn" href="' + colonia.u + '" title="Ubicación" target="_blank">' +
                    '<img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">' +
                    '</a>' +
                    '</td>'  +
                    '@can("crear-colonia")' +
                    '<td style="padding: 10px">' +
                    '<a style="background-color: #415A5A; color: white; margin-bottom: 5%;" class="btn" href="/colonias/' + colonia.id + '/edit" title="Editar colonia">Editar</a>' +
                    '<form method="POST" action="/colonias/' + colonia.id + '" style="display:inline" id="deleteForm-' + colonia.id + '">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<input type="submit" class="btn btn-danger" onclick="return confirmarEliminar(' + colonia.id + ')" value="Borrar">' +
                    '</form>' +
                    '</td>' +
                    '@endcan' +
                    '</tr>';
                $('#miTabla tbody').append(row);
                $i++;
                console.log($i);
            });

            // Actualizar la configuración de la paginación
            var newTotalRecords = $i; // Número total de registros después del filtro
            $('#miTabla').DataTable().settings()[0]._iRecordsTotal = newTotalRecords;
            $('#miTabla').DataTable().settings()[0]._iRecordsDisplay = newTotalRecords;
            $('#miTabla').DataTable().draw(); // Redibujar la tabla con la nueva configuración de paginación
        },

        error: function(xhr, status, error) {
            console.error('Error al obtener datos:', error);
        }
    });
}
</script>

<script>
  // Inicializamos el DataTable en la tabla
  $('#miTabla').DataTable({
    lengthMenu: [
      [100, 200, 400],
      [100, 200, 400]
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
    // Desactivar la ordenación inicial
    "order": []

  });
</script>



@endsection
