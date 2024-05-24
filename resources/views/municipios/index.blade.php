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
      <h3 style="color:black" class="page__heading">Municipios</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div  class="card">
              <div  class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
              <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Filtros de Busqueda</p></strong>
              </div>
              <div style="background-color: #F4F6F9; height: 120px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <!-- Elementos de filtrado-->
                    <label style="font-family: Nunito; font-size: 13.5px; color:black" for="estado">Estado</label>
                    <div class="d-flex align-items-center">
                    <select style="width: 20%; background-color: #CC0033; color: white; border-color: #CC0033;  " id="estado" class="form-control" onchange="filtro_estado(this)">
                      <option value="0">----Todos----</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nombre}}
                      </option>
                      @endforeach
                    </select>
                    <!--
                    <a style="background-color: #457766; font-size: 13.5; font-family: nunito; color: white; margin-left: 31.3%; width: 15.8%" class="btn" href="{{ route('municipios.index') }}" title="Todos">Limpiar</a>
                    -->
                    </div>
                    <div><br></div>
                    <script>
                    // Imprimir el JSON de municipios en la consola
                    console.log(@json($municipios));
                    </script>
                  </div>
                </div>
              </div>
            </div>  
                     <!-- Creamos la tabla para mostrar los municipios -->
            <table class="table table-striped mt-2 table_id" id="miTabla">
              <thead>
                 <tr>
                  <th style="color: white; width: 20%;">No. Municipio</th>
                  <th style="color: white; width: 50%">Nombre</th>
                  <th style="color: white; width: 20%;">Estado</th>
                  <th style="color: white; width: 10%;">Ubicacion</th>
                </tr>
              </thead>
              <tbody id="tablaBody">
                <!-- Iteramos sobre los municipios y los mostramos en la tabla -->
                @foreach ($municipios as $municipio)
                <tr>
                  <td style="padding-left: 25px;">{{ $municipio->no }}</td>
                  <td>{{ $municipio->n_m }}</td>
                  <td>{{ $municipio->n_e }}</td>
                  <!--Agregamos el enlace para la ubicacion de los munnicipios en el Mapa--->
                  <td style="text-align: center;">
                    @if($municipio->u)
                    <a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn"  href="{{ $municipio->u }}" title="Ubicación"  target="_blank">
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
    // Inicializamos el DataTable en la tabla y su paginacion
    var table =$('#miTabla').DataTable({
    lengthMenu: [
      [10,100, 200, 400], //Opciones de paginacion del desplegable
      [10,100, 200, 400] //Paginacion de la tabla
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
    // Desactivamos la ordenación inicial del DataTable
    "order": []
  });
</script>

<!--Script para filtrar los elementos de la tabla en base al desplegable #estado-->
<script>
  function filtro_estado() {
    // Obtener el ID del estado seleccionado
    var estado_id = $('#estado').val();
    console.log(estado_id);
    // Realizar una petición AJAX para obtener los datos filtrados
    $.ajax({
        //Llamos al metodo del controlador y le paso el id del estado seleccionado si es el caso
        url: estado_id > 0 ? '/municipios/filtro_municipio/' + estado_id : '/municipios/filtro_municipio_all',
        method: 'POST',
        data: { id: estado_id, _token: '{{ csrf_token() }}' }, // Datos a enviar al controlador
        //Rellana la tabla al obtener una respuesta del controlador
        success: function(response) {
            table.clear();
            // Destruimos la instancia existente del DataTable antes de limpiar la tabla
            $i = 0; //Contador de los elementos filtrados
            // Iterar sobre los datos recibidos y agregarlos a la tabla
            $.each(response, function(index, municipio) {
                // Determinamos si el enlace debe agregarse
                var link = municipio.u ? '<a style="background-color: #326565; color: white; width:42px; height: 42px" class="btn" href="' + municipio.u + '" title="Ubicación" target="_blank"><img src="{{ asset('img/ubicacion.png') }}" alt="Ubicacion Icon" style="width: 30px; height: 30px; margin-left: -7px;"></a>' : '';

                // Agregar el registro a DataTable
                table.row.add([
                    municipio.no,
                    municipio.n_m,
                    municipio.n_e,
                    link
                ]);
                $i++;
            });
            console.log($i);//Imprimimos el contador en consola para saber los municipios filtrados
            // Redibujar la tabla una vez después de añadir todas las filas
            table.draw();
        },
        //Si ocurre algun error al obtener los municipios pertenecientes a un estado lo imprimimos por consola
        error: function(xhr, status, error) {
            console.error('Error al obtener datos:', error);
        }
    });
  }
</script>
@endsection