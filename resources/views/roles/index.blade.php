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
        <h3 style="color: black;" class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('roles.create') }}" title="Crear nuevo rol">Nuevo rol</a>
                        <div>
                            <br>
                        </div>
                        {{-- @can('crear-rol')
                        <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
                        @endcan
                         --}}

                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                                <thead>
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff; width: 60%;">Rol</th>
                                    <th style="color:#fff; width: 40%;">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td style="display: none;">{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('editar-rol')
                                            <a style ="background-color: #326565; color: white"  class="btn" href="{{ route('roles.edit',$role->id) }}" title="Editar role">Editar</a>
                                        @endcan

                                        @can('borrar-rol')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $role->id]) !!}
                                        {!! Form::submit('Borar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $role->id . ')']) !!}
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
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!}
                            </div>
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
        new DataTable('#miTabla2', {
    lengthMenu: [
        [3, 5, 10],
        [3, 5, 10]
    ],

    columns: [
        { Id: 'Id' },
        { Name: 'Name' },
        // { Guard_name: 'Guard_name'},
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
