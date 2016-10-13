@extends('layouts.principal')

@section('style')
    <style>
        .subtext{
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
<!---->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}">Inicio</a></li>
        <li class="active">Registro</li>
    </ol>
    <div class="row">

        <div class="col-md-12 section-heading text-center">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8 col-md-offset-2 subtext ">
                                <h3>Ingresa el correo asociado a tu cuenta</h3>
                            </div>
                            {!!Form::open(['route' => 'postReset','id'=>'canchastipo','class'=>'form-horizontal', 'method'=>'POST'])!!}

                            {!! Form::hidden('token',$token,null) !!}

                            <div class="form-group">
                                {!! Form::label('correo', 'E-Mail',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        {{--{!! Form::text("email",null,['value'=>"{{old('email')}}",'class'=>'form-control']) !!}--}}
                                        <input type="email" id="correo" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group passNueva">
                                        {!! Form::label('password', 'Nueva',['class'=>'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!!Form::password('password',['class'=>'form-control','placeholder'=>"Nueva contraseña",  'required' ])!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group passNueva">
                                        {!! Form::label('password_confirmation', 'Confirmar',['class'=>'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!!Form::password('password_confirmation',['class'=>'form-control','placeholder'=>"Confirmar contraseña" , 'required'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="text-decoration: none; color: #000;">&times;</a>
                                    <strong>Ups!</strong> Favor corregir los siguientes errores.<br><br>
                                    <ul class="text-left">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-12">
                                    {!! Form::submit('Restableser Contraseña!',['class'=>'mybutton center-block']) !!}
                                </div>
                            </div>
                            {!!Form::close()!!}


                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>
<!---->
@endsection

@section('scripts')

    <script>
        $(function() {
            $("#correo").blur(function () {
                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if ($(this).val() != "") {
                    if (!expr.test($(this).val())) {
                        $(this).parent().addClass("has-error");
                        $(this).focus();
                    }
                    else {
                        $(this).parent().removeClass("has-error");
                        $(this).parent().addClass("has-success");
                    }
                }
                else {
                    $(this).parent().removeClass("has-error");
                    $(this).parent().removeClass("has-success");
                }
            });

        });
    </script>



@endsection