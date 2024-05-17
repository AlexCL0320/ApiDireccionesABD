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
            <!-- Agregamos un enlace para crear un nuevo municipio si el usuario tiene el permiso -->
            @can('crear-municipio')
            <!--<a class="btn btn-warning" href="{{ route('municipios.create') }}" title="Crear nuevo municipio">Agregar municipio</a>-->
            @endcan
             <!-- Elementos de filtrado-->
            <label for="estado"><h6>Estado</h6></label>
            <br>
            <div>
            <select style="width: 20%" id="estado" class="form-control" onchange="filtro_estado(this)">
              <option value="">----Selecciona estado----</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nombre_estado}}
              </option>
              @endforeach
            </select>
            </div>
            <div><br></div>
            <script>
            // Imprimir el JSON de colonias en la consola
            console.log(@json($municipios));
            </script>
            @php
            $primerElementoSeleccionado = false; // Asigna un valor a la variable
            @endphp
            <!-- Creamos la tabla para mostrar los municipios -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead style="background-color:#326F8A">
                 <tr>
                  <th style="color: white; width: 20%">No. Municipio</th>
                  <th style="color: white; width: 50%">Nombre</th>
                  <th style="color: white; width: 30%;">Estado</th>
                  <!--<th style="color: white;">Acciones</th>-->
                </tr>
              </thead>
              <tbody id="tablaBody">
                <!-- Iteramos sobre los municipios y los mostramos en la tabla -->
                @foreach ($municipios as $municipio)
                <tr>
                  <td>{{ $municipio->id }}</td>
                  <td>{{ $municipio->n_m }}</td>
                  <td>{{ $municipio->n_e }}</td>
                  <!--<td style="padding: 10px">     
                    <a style="background-color: #326565; color: white; margin-bottom: 5%;" class="btn" href="{{ route('municipios.edit', $municipio->id) }}" title="Editar estado">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['municipios.destroy', $municipio->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $municipio->id]) !!}
                      {!! Form::submit('Eliminar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $municipio->id . ')']) !!}
                    {!! Form::close() !!}

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
                  </td>-->
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

<script>
    $(document).ready(function() {
       window.primerElementoSeleccionado = false;

        $('#estado').on('change', function() {
            var valorSeleccionado = $(this).val();
            var primerElemento = $(this).find('option:first').val();

            if (valorSeleccionado === primerElemento) {
                primerElementoSeleccionado = true;
            } else {
                primerElementoSeleccionado = false;
            }
        });

        // Ahora puedes usar la variable primerElementoSeleccionado para saber si se ha seleccionado el primer elemento
    });
</script>

<!--Script para filtrar los elementos de la tabla en base al desplegable-->
<script>
  function filtro_estado() {
    // Obtener el ID del estado seleccionado
    var estado_id = $('#estado').val();
    console.log(estado_id);
    // Realizar una petición AJAX para obtener los datos filtrados
    $.ajax({
        url: '/municipios/filtro_municipio/' + estado_id, // Actualizado para usar la ruta correcta
        method: 'POST',
        data: { id: estado_id, _token: '{{ csrf_token() }}' }, // Datos a enviar al controlador
        success: function(response) {
            // Limpiar la tabla
            $('#miTabla tbody').empty();
            $i = 0;
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            $.each(response, function(index, municipio) {
                var row = '<tr>' +
                    '<td>' + municipio.id + '</td>' +
                    '<td>' + municipio.n_m + '</td>' +
                    '<td>' + municipio.n_e + '</td>' +
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

            // Destruir la instancia existente del DataTable y reinstalarla para reflejar los nuevos datos
            $('#miTabla').DataTable().destroy();
            $('#miTabla').DataTable();

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