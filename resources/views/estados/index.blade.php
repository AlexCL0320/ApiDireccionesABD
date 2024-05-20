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
        padding: 16px;
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
      <h3 style="color:black" class="page__heading">Estados</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- Agregamos un enlace para crear un nuevo estado -->
           <!-- <a class="btn btn-warning" href="{{ route('estados.create') }}" title="Crear nuevo estado">Agregar estado</a>-->
           <div><br></div>
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead>
                <tr>
                  <th style="color: white; width: 20%">No. Estado</th>
                  <th style="color: white; width: 50">Nombre</th>
                  <th style="color: white; width: 30%">Ubicacion</th>
                </tr>
              </thead>
              <tbody>
                <!-- Iteramos sobre los estados y los mostramos en la tabla -->
                @foreach ($estados as $estado)
                <tr>
                  <td style="padding-left: 25px;">{{ $estado->id }}</td>
                  <td>{{ $estado->nombre}}</td>
                  <!--Agregamos el enlace para la ubicacion de los estados en el Mapa--->
                  <td>
                    @if($estado->u)
                    <a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn"  href="{{ $estado->ubicacion }}" title="Ubicación"  target="_blank">
                    <img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;">
                    </a>
                    @endif
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
      [5, 10, 15],
      [5, 10, 15]
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
  });
</script>
@endsection
