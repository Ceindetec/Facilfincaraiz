@extends('layouts.principal')

@section('style')

@endsection

@section('content')


    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Buscar inmueble</li>
        </ol>
        <div class="welcome-left col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center" style="margin-bottom: 2%">
            <h2>Encuetra lo que necesitas</h2>
            <h3>fácil, rápido y seguro</h3>
        </div>

        {!! Form::open() !!}
        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
            <div class="form-group">
                {!! Form::select('accion',['1'=>"Vendo","2"=>"Arriendo","3"=>"Permuto"], null,["class"=>"form-control"]) !!}
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
            <div class="form-group">
                {!! Form::select('categoria',['1'=>"Vendo","2"=>"Arriendo","3"=>"Permuto"], null,["class"=>"form-control"]) !!}
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
            <div class="form-group">
                {!! Form::select('departamento',$items, null,["class"=>"form-control"]) !!}
            </div>
        </div>

        {!! Form::close() !!}


    </div>

@endsection

@section('scripts')


@endsection