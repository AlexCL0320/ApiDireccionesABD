@extends('layouts.app')
<style>
    .uppercase-input {
    text-transform: uppercase;
}
</style>
@section('content')
<section class="section">
        <div class="section-header">
        <a href="">
        <h3 style="color: black;" class="page__heading">Registrar Direccion</h3>
        </a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <label class="text-danger">Los campos con * son obligatorios</label>
                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::open(array('route' => 'direcciones.store','method'=>'POST')) !!}
                        <!-- Otros campos del formulario -->

                        <!-- Campo oculto para pasar el ID de la categoría -->
                        {!! Form::hidden('categoria_id', $categoria->id) !!}

                        
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label  for="nombre">Nombre</label><span class="required text-danger">*</span>
                                    {!! Form::text('nombre', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="marca">Marca</label><span class="required text-danger">*</span>
                                    {!! Form::text('marca', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="stock">Stock</label><span class="required text-danger">*</span>
                                    {!! Form::number('stock', null, array('class' => 'form-control uppercase-input', 'id' => 'stock')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label><span class="required text-danger"></span>
                                    {!! Form::text('descripcion', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="precio_compra">Precio Compra</label><span class="required text-danger">*</span>
                                    {!! Form::number('precio_compra', null, array('class' => 'form-control uppercase-input', 'step' => 'any')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="precio_venta">Precio venta</label><span class="required text-danger">*</span>
                                    {!! Form::number('precio_venta', null, array('class' => 'form-control uppercase-input', 'step' => 'any')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="codigo">Código</label><span class="required text-danger">*</span>
                                    {!! Form::number('codigo', null, array('class' => 'form-control uppercase-input')) !!}
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label><span class="required text-danger">*</span>
                                {!! Form::select('categoria', [$categoria->nombre], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button style="background-color: #326565; color:white" type="submit" class="btn">Guardar</button>
                                <a href="{{ route('insumos.index', $categoria->id) }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                        
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

