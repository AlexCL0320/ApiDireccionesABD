@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Estados</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Agregamos un enlace para crear un nuevo estado -->
            <a class="btn btn-warning" href="{{ route('estados.create') }}" title="Crear nuevo estado">Agregar estado</a>
            <div><br></div>
            <!-- Creamos la tabla para mostrar los estados -->
            <table class="table table-striped mt-2" id="miTabla">
              <thead style="background-color:#6777ef; color: white;">
                <tr>
                  <th style="color: white;">ID</th>
                  <th style="color: white;">Nombre del Estado</th>
                  <th style="color: white;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- Iteramos sobre los estados y los mostramos en la tabla -->
                @foreach ($estados as $estado)
                <tr>
                  <td>{{ $estado->id }}</td>
                  <td>{{ $estado->nombre_estado }}</td>
                  <td style=" display: flex; justify-content: space-between; gap: 10px; padding: 10px">
                    <!-- Agregamos enlaces para editar y eliminar cada estado -->
                    <a class="btn btn-info" href="{{ route('estados.edit', $estado->id) }}" title="Editar estado">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['estados.destroy', $estado->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
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
