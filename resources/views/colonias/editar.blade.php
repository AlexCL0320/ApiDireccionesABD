@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 style="color:black" class="page__heading">Editar Colonia</h3>
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
                        
                        <div id="segundoFormulario" class="card">
                            <div class="card-header" style="background-color: black; margin-bottom: -20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
                                <strong><p style="font-size: 16px; font-family: nunito; color: White; margin-top: -10px;" class="card-title">Datos</p></strong>
                            </div>
                            <div style="background-color: #F4F6F9; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);" class="card-body">
                                <div class="row">      
                                    <div class="col-lg-12">
                                    <label class="text-danger">Los campos con * son obligatorios</label>
                                    {!! Form::model($colonia, ['method' => 'PATCH','route' => ['colonias.update', $colonia->id]]) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label><span class="required text-danger">*</span>
                                                {!! Form::text('nombre_col', $colonia->n, array('class' => 'form-control', 'id' => 'nombre')) !!}
                                            </div>
                                            <div class="form-group">
                                                    <label for="cp_lbl">Código Postal</label><span class="required text-danger">*</span>
                                                    {!! Form::text('codigo_postal_col', null, ['class' => 'form-control', 'readonly', 'id' => 'cp2', 'style' => 'width: 20%;']) !!}
                                                </div>
                                                <div class="d-flex align-items-center" style="margin-top: -1%">
                                                    <div>
                                                    <label style="color:black; font-family: nunito; font-size: 13.5px" for="cp_lbl">Estado</label><span class="required text-danger">*</span>
                                                        {!! Form::text('estado_col', null, ['class' => 'form-control', 'readonly', 'id' => 'estado2', 'style' => 'width: 120%;']) !!}
                                                    </div>
                                                    <div style="margin-left: 5%;">
                                                        <label style="color:black; font-family: nunito; font-size: 13.5px">Municipio</label><span class="required text-danger">*</span>
                                                        {!! Form::text('municipio_col', null, ['class' => 'form-control', 'readonly', 'id' => 'municipio2', 'style' => 'width: 220%;']) !!}
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            <div style="margin-left: 1.5%;">
                                                <label style="color:black; font-family: nunito; font-size: 13.5px" for="nombre">Colonia Origen</label><span class="required text-danger">*</span>
                                                <select style="width: 100%; margin-right: 5%; margin-top:0%" id="colonia2" class="form-control" disabled>   
                                                </select>
                                            </div>
                                            <br>
                                            <div style="margin-left: 2%;">
                                                <label style="color:black; font-family: nunito; font-size: 13.5px">Ubicacion</label><span class="required text-danger">*</span>
                                                {!! Form::text('ubicacion', null, ['class' => 'form-control', 'id' => 'ubicacion', 'style' => 'width: 260%;']) !!}
                                            </div>
                                        </div>
                                        <div style="margin-left: -1% ;margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12">
                                            <button style="background-color: #326565; color:white" type="submit" class="btn">Guardar</button>
                                            <a href="/usuarios" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
