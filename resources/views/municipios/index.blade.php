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
            <a class="btn btn-warning" href="{{ route('municipios.create') }}" title="Crear nuevo municipio">Agregar municipio</a>
            @endcan
            <div><br></div>
            <!-- Creamos la tabla para mostrar los municipios -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead style="background-color:#326F8A">
                 <tr>
                  <th style="color: white;">Estado</th>
                  <th style="color: white;">No. Municipio</th>
                  <th style="color: white;">Nombre</th>
                  <th style="color: white;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- Iteramos sobre los municipios y los mostramos en la tabla -->
                @foreach ($municipios as $municipio)
                <tr>
                  <td>{{ $municipio->estado_id }}</td>
                  <td>{{ $municipio->numero_municipio }}</td>
                  <td>{{ $municipio->nombre }}</td>
                  <td style=" display: flex; justify-content: space-between; gap: 10px; padding: 10px">
                    <!-- Agregamos enlaces para editar y eliminar cada municipio si el usuario tiene los permisos correspondientes -->
                    @can('editar-municipio')
                    <a class="btn btn-info" href="{{ route('municipios.edit', $municipio->id) }}" title="Editar municipio">Editar</a>
                    @endcan
                    @can('borrar-municipio')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['municipios.destroy', $municipio->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan
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
<script>
  // Inicializamos el DataTable en la tabla
  $('#miTabla').DataTable({
    lengthMenu: [
      [2, 5, 10],
      [2, 5, 10]
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
  });
</script>
@endsection