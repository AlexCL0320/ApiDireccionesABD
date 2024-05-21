@extends('layouts.app')

@section('content')

<!--Estilo para dar formato a la tabla -->
<style>
    /* Estilos para la tabla */
    .table_id {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para las celdas de la tabla */
    .table_id th, .table_id td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Estilo para encabezado */
    .table_id tr:nth-child(odd) {
        background-color: #326F8A;
    }
    /* Estilo para filas pares en el cuerpo de la tabla */
    .table_id tbody tr:nth-child(even) {
      background-color: white;
    }

    /* Estilo para filas impares en el cuerpo de la tabla */
    .table_id tbody tr:nth-child(odd) {
      background-color: #EEEEEE;
      
    }
</style>


<section class="section">
  <div class="section-header">
      <h3 style="color:black" class="page__heading">Usuarios</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">


                      <a class="btn btn-warning" href="{{ route('usuarios.create') }}" title="Crear nuevo usuario">Agregar usuario</a>
                      <div>
                      <br>
                      </div>

                         <!-- <form  class="d-flex">
                         <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>
                         &emsp;
                          <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" placeholder="Ingresa el nombre a buscar...">

                         </form> -->



                            <table class="table table-striped mt-2 table_id" id="miTabla">
                              <thead>
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre</th>
                                  <th style="color:#fff;">Apellido Paterno</th>
                                  <th style="color:#fff;">Apellido Materno</th>
                                  <th style="color:#fff;">Correo</th>
                                  <th style="color:#fff;">Rol</th>
                                  <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($usuarios as $usuario)
                                  <tr>
                                    <td style="display: none;">{{ $usuario->id }}</td>
                                    <td>{{ $usuario->nombre }}</td>
                                    <td>{{ $usuario->apellido_p }}</td>
                                    <td>{{ $usuario->apellido_m }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td style="align-items: center;">
                                      @if(!empty($usuario->getRoleNames()))
                                        @foreach($usuario->getRoleNames() as $rolNombre)
                                          <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                        @endforeach
                                      @endif
                                    </td>
                                    <td style="padding: 10px">
                                      @if($usuario->email != 'admin@gmail.com')
                                      <a style="background-color: #326565; color: white; margin-bottom: 0%;" class="btn" href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar usuario">Editar</a>        
                                      {!! Form::open(['method' => 'DELETE', 'route' => ['usuarios.destroy', $usuario->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $usuario->id]) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $usuario->id . ')']) !!}
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
                                        @endif
                                      </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->

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
        new DataTable('#miTabla', {
    lengthMenu: [
        [2, 5, 10],
        [2, 5, 10]
    ],

    columns: [
        { Id: 'Id' },
        { Nombre: 'Nombre' },
        { Apellido Paterno: 'Apellido Paterno' },
        { Apellido Materno: 'Apellido Materno' },
        { Telefono: 'Telefono' },
        { Email: 'E-mail' },
        { Rol: 'Rol' },
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
