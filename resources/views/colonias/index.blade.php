@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Colonias</h3>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <a class="btn btn-outline-dark" href="{{ route('colonias.create') }}" style="background-color: #afc1c1; border-color: #ffffff; color: black; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);" title="Crear nueva colonia">Agregar colonia</a>
                      <div><br></div>
                      
                          <table class="table table-striped mt-2 table-sm" id="miTabla3">
                              <thead style="background-color:#326565">
                                  <th style="text-align: center;display: none;">ID</th>
                                  
                                  <th style="text-align: center;color:#fff; white-space: nowrap;">Municipio</th>
                                  <th style="text-align: center;color:#fff; white-space: nowrap;">Colonia</th>
                                  <th style="text-align: center;color:#fff; white-space: nowrap;">Acciones</th>
                              </thead>
                              <tbody>
                                  @foreach ($colonias as $colonia)
                                  <tr>
                                      <td style="display: none;">{{ $colonia->id }}</td>
                                      
                                      <td style="text-align: center;">{{ $colonia->municipio->nombre }}</td>
                                      <td style="text-align: center;">{{ $colonia->nombre }}</td>
                                      <td style="text-align: center;color:#fff; white-space: nowrap;">
    <!-- Botón de editar -->
    <a class="btn btn-info" href="{{ route('colonias.edit', $colonia->id) }}" title="Editar estado"><i class="fas fa-edit"></i></a>

    <!-- Espacio entre los botones -->
    <span style="margin-right: 15px;"></span>

    <!-- Botón de eliminar -->
    {!! Form::open(['method' => 'DELETE', 'route' => ['colonias.destroy', $colonia->id], 'class' => 'formulario-eliminar', 'style' => 'display:inline']) !!}
    <button type="submit" class="btn btn-danger" title="Eliminar estado"><i class="fas fa-trash-alt"></i></button>
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
<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    // Inicializamos el DataTable en la tabla
    $('#miTabla3').DataTable({
        lengthMenu: [
            [2, 5, 10],
            [2, 5, 10]
        ],
        columns: [
        { id: 'id', searchable: false },
        { id: 'municipio', searchable: false },
        { id: 'nombre', searchable: true }, // Hacer searchable true solo para nombre
        { id: 'acciones', searchable: false },
    ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });

    $(document).ready(function() {
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            Swal.fire({
                title: "¿Está seguro de eliminar la colonia?",
                text: "¡No se podrán revertir los cambios!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, enviar el formulario
                    $(this).unbind('submit').submit(); // Esto no es necesario ahora
                    // Simplemente enviamos el formulario
                    // this.submit(); // Esta es la forma correcta de enviar el formulario
                }
            });
        });
    });
</script>
@if(session('eliminar')=='ok')
<script>
    Swal.fire({
        title: "¡Eliminado correctamente!",
        text: "Colonia eliminada",
        icon: "success"
    });
</script>
@endif
@endsection