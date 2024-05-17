@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 style="color:black" class="page__heading">Alta de colonias</h3>
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

                        {!! Form::open(array('route' => 'colonias.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label><span class="required text-danger">*</span>
                                    {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
                                </div>

                                <div class="d-flex align-items-center" style="margin-top: -4%">
                                <label for="nombre">Estado</label><span class="required text-danger">*</span>
                                <label style="margin-left: 20%;" for="nombre">Municipio</label><span class="required text-danger">*</span>
                                <select style="width: 20%; margin-left: -30.1%; margin-right: 5%; margin-top:6%" id="estado" class="form-control" onchange="filtro_estados(this); filtro_estado(this)">    
                                    <option value="">----Selecciona Estado----</option>
                                        @foreach($estados as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->nombre_estado}}</option>
                                        @endforeach
                                </select>
                                <select style="width: 50%; margin-left: -1%;margin-top:6%" id="municipio" class="form-control" onchange="filtro_municipio(this)">
                                    <option value="">----Selecciona Municipio----</option>
                                </select>
                                </div>
                                
                                <div class="d-flex align-items-center" style="margin-bottom: 2%">
                                <label for="nombre">Codigo Postal</label><span class="required text-danger">*</span>
                                <select style="width: 50%; margin-left: -8.1%; margin-top:6%;" id="municipio" class="form-control" onchange="filtro_municipio(this)">
                                    <option value="">----Selecciona CP----</option>
                                </select>
                                </div>

                                <div class="form-group">
                                    <label for="nombre">No. Colonia</label><span class="required text-danger">*</span>
                                    {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div style="margin-top: 2%;" class="col-xs-12 col-sm-12 col-md-12">
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
    </section>
@endsection
