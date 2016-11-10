@extends('layouts.principal')

@section('style')

@endsection

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="active">Buscar vehiculo</li>
        </ol>
        <div class="welcome-left col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center" style="margin-bottom: 2%">
            <h2>Encuetra lo que necesitas</h2>
            <h3>fácil, rápido y seguro</h3>
        </div>

        {!!Form::open(['route'=>'getVehiculos','id'=>'formVehiculo','autocomplete'=>'off'])!!}
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    {!!Form::select('categorias',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Selecciona una categoria', 'required'])!!}
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    {!!Form::select('marca',[], null, ['id'=>'marca','class'=>"form-control",'placeholder' => 'Selecciona una marca'])!!}
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        {!!Form::text('modelo', null, ['id'=>'modelo','class'=>"form-control pull-right",'placeholder' => 'Selecciona un modelo', 'readonly'])!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
                <div class="form-group">
                    {!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Selecciona un departamento', 'required', 'id' => 'departamento'])!!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    {!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecciona un municipio', 'id'=>'municipio_id'])!!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="mybutton center-block">Buscar</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')


@endsection