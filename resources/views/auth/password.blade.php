@extends('layouts.principal')

@section('style')
    <style>
        .subtext{
            margin-bottom: 30px;
        }
        .cargando{
            font-size: 16px;
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
                            <div class="col-md-8 col-md-offset-2 subtext">
                                <h3>Ingresa el correo asociado a tu cuenta</h3>
                            </div>
                            {!!Form::open(['id'=>'formEnviarEmail','class'=>'form-horizontal'])!!}

                            <div class="form-group">
                                {!! Form::label('correo', 'E-Mail',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="ejemplo@miscanchas.com" name="email" id="correo" required>
                                    </div>
                                </div>
                            </div>

                            <div id="alertContacto" class="">


                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group ">
                                        {{--<input class="btn btn-primary btn-lg" value="Send Message" type="submit" >--}}
                                        <button class="mybutton center-block " type="submit">Enviar <i class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
                                            <span class="sr-only">Loading...</span> </button>
                                    </div>
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


            var formEnviarEmail = $("#formEnviarEmail");

            formEnviarEmail.submit(function (e) {
                e.preventDefault();
                $(".cargando").removeClass("hidden");
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('postEmail')}}',
                    data:formEnviarEmail.serialize(),
                    success: function(data){
                        $(".cargando").addClass("hidden");
                        $("#alertContacto").empty();
                        if (data=="enviado") {
                            html = '<div class="alert alert-success">'+
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                                    '<strong>Perfecto!</strong> un link para restablecer la contraseña fue enviado a este correo'+
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                        else {
                            html = '<div class="alert alert-danger">'+
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                                    '<strong>Ups!</strong> La información proporcionada no coincide con nuestros registros ...'+
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                    },
                    error: function(){
                        console.log('ok');
                    }
                });

            });

        });;



    </script>



@endsection