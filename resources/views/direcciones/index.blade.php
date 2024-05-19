@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 style="color:black" class="page__heading">Direcciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
            
                        @can('registrar-direccion')
                        <a class="btn btn-warning" href="{{ route('direcciones.create') }}">Registrar dreccion</a>
                        <br><br>
                        @endcan
            
                        <table class="table table-striped mt-2 table_id" id="miTabla">
                               <thead style="background-color:#326F8A">
  
                                    <th style="display: none;">Titular</th>
                                    <th style="color:#fff;">Calle</th>
                                    <th style="color:#fff;">Numero Exterior</th>                                    
                                    <th style="color:#fff;">Numero Interior</th>
                                    <th style="color:#fff;">Estado</th>                                   
                                    <th style="color:#fff;">Municipio</th>
                                    <th style="color:#fff;">Colonia</th> 
                                    <th style="color:#fff;">CP</th>                       
                                    <th style="color: white; width: 10%">Acciones</th>                                                                
                              </thead>
                              <tbody>
                            @foreach ($direcciones as $direccion)
                            <tr>
                                <td style="display: none;">{{ $direccion->id }}</td>                                
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->calle }}</td>
                                <td>{{ $direccion->numero_ex }}</td>
                                <td>{{ $direccion->numero_int }}</td>
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                </td>
                                <!--Opciones de edicion para el rol Capturista-->
                                <td style="padding: 10px">     
                                <a style="background-color: #415A5A; color: white; margin-bottom: 5%;" class="btn" href="{{ route('direcciones.edit', $direccio ->id) }}" title="Editar direccion">Editar</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['direcciones.destroy', $direccion->id], 'style' => 'display:inline', 'id' => 'deleteForm-' . $direccion->id]) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'return confirmarEliminar(' . $direccion->id . ')']) !!}
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