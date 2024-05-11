@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Direcciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-blog')
                        <a class="btn btn-warning" href="{{ route('blogs.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#326565">                                     
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
                            @foreach ($blogs as $blog)
                            <tr>
                                <td style="display: none;">{{ $blog->id }}</td>                                
                                <td>{{ $blog->titulo }}</td>
                                <td>{{ $blog->contenido }}</td>
                                <td>{{ $blog->titulo }}</td>
                                <td>{{ $blog->contenido }}</td>
                                <td>{{ $blog->titulo }}</td>
                                <td>{{ $blog->contenido }}</td>
                                <td>{{ $blog->titulo }}</td>
                                <td>{{ $blog->contenido }}</td>
                                <td>
                                    <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">                                        
                                        @can('editar-blog')
                                        <a class="btn btn-info" href="{{ route('blogs.edit',$blog->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-blog')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $blogs->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
