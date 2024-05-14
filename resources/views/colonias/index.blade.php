@extends('layouts.app')

@section('content')
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
            @endcan
            <div><br></div>
            <!-- Creamos la tabla para mostrar los colonias -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead style="background-color:#326F8A">
                 <tr>
                  <th style="color: white;">Estado</th>
                  <th style="color: white;">Municipio</th>
                  <th style="color: white;">No. Colonia</th>
                  <th style="color: white;">Nombre</th>
                  <!--<th style="color: white;">Acciones</th>-->
                </tr>
              </thead>
              <tbody>
                <!-- Iteramos sobre los colonias y los mostramos en la tabla -->
                @foreach ($colonias as $colonia)
                <tr>
                  <td>{{ $colonia->n_e }}</td>
                  <td>{{ $colonia->n_m }}</td>
                  <td>{{ $colonia->id }}</td>
                  <td>{{ $colonia->n }}</td>
                  <!--<td style="padding: 10px">     
                   <a style="background-color: #326565; color: white; margin-bottom: 5%;" class="btn" href="{{ route('colonias.edit', $colonia->id) }}" title="Editar colonia">Editar</a>
                   {!! Form::open(['method' => 'DELETE', 'route' => ['colonias.destroy', $colonia->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $colonia->id]) !!}
                      {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $colonia->id . ')']) !!}
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
  // Inicializamos el DataTable en la tabla
  $('#miTabla').DataTable({
    lengthMenu: [
      [100, 200, 400],
      [100, 200, 400]
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
  });
</script>
@endsection