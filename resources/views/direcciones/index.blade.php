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
                
            
                        @can('crear-direccion')
                        <a class="btn btn-warning" href="{{ route('direcciones.create') }}">Nuevo</a>
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
                              </thead>
                              <tbody>
                            @foreach ($direcciones as $direccion)
                            <tr>
                                <td style="display: none;">{{ $direccion->id }}</td>                                
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                <td>{{ $direccion->titulo }}</td>
                                <td>{{ $direccion->contenido }}</td>
                                <td>
                                    <form action="{{ route('direccions.destroy',$direccion->id) }}" method="POST">                                        
                                        @can('editar-direccion')
                                        <a class="btn btn-info" href="{{ route('direccions.edit',$direccion->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-direccion')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
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