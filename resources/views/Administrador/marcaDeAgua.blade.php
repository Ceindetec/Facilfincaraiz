@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins\jQueryUI\jquery-ui.css')!!}
    {!!Html::style('plugins/ceindetecFileInput/css/ceindetecFileInput.css')!!}

    <style>
        .mybutton {
            padding: 6px 10px;
        }
    </style>


@endsection

@section('content')
    <!---->

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route("home")}}">Inicio</a></li>
            <li class="active">Marca de Agua</li>
        </ol>

        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            {!!Form::open(['id'=>'formbuscarUser','class'=>'form-horizontal'])!!}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="usuario" class="col-sm-4 control-label">Usuario</label>
                                    <div class="col-sm-8">
                                        {!!Form::text('usuario',null,['id'=>'usuario','class'=>'form-control','placeholder'=>"usuario a colocar marca de agua", 'required',"onkeyup"=>"buscarUsuario(this)"])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </div>

                            </form>

                        </div>
                        <div class="row hidden" id="infUser">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="h3Josefin text-center">Informacón del
                                            Usuario</h3></div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-user"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="nombres"> luis carlos pineda</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-phone"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="telefono"> 7777777777</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-envelope"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="email"> luispineda@ceindete.org.co</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-center">
                                                <img src="images/marcasDeAgua/marcaAgua.png"
                                                     class="img-responsive imagen" id="imagen" alt=""
                                                     style="width: 150px;margin: 10px auto">
                                                <div class="conteEliminar">
                                                    <i data-id="" class="fa fa-trash eliminarImage" aria-hidden='true' data-toggle='confirmation' data-popout="true" data-placement='top' title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                                </div>
                                                marca de Agua
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-xs-12">
                                                {!!Form::open(['id'=>'formMarcadeAgua','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}

                                                <div class="form-group">
                                                    <label for="titulo" class="col-sm-4 control-label">Cargar Marca de Agua</label>
                                                    <div class="col-sm-6">
                                                        <input type="file" id="files" name="files[]" multiple required style="width: 200px; height: 35px;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-8">
                                                        <button type="submit" class="mybutton center-block" id="submit">Cargar Marca de Agua</button>
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
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios con marcas de Agua</h3>
                    </div>
                    <div class="panel-body">
                        Panel content
                    </div>
                </div>
            </div>
        </div>
    </div>
    >
    <!---->
@endsection

@section('scripts')

    {!!Html::script('plugins\jQueryUI\jquery-ui.min.js')!!}
    {!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}
    <script>

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $("#files").inputFileImage({
                maxlength: 1,
                width: 120,
                height: 140,
                minType: ["png"],
                maxfilesize: 1024
            });
            var formbuscarUser = $("#formbuscarUser");
            formbuscarUser.submit(function (e) {
                e.preventDefault();
                traerInfUsuer($("#usuario").val());
            });

            var formMarcadeAgua = $("#formMarcadeAgua");
            formMarcadeAgua.submit(function (e) {
                e.preventDefault();

            });





        });

        function buscarUsuario(elemento) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('autoCompleUsuarios')}}',
                data: {"nombre": $(elemento).val()},
                success: function (data) {
                    // console.log(data);
                    $("#usuario").autocomplete({
                        source: data,
                        select: function (event, ui) {
                            traerInfUsuer(ui.item.value);
                        }
                    });
                },
                error: function () {
                    console.log('ok');
                }
            });
        }

        function traerInfUsuer(user) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('infoUsuario')}}',
                data: {"nombre": user},
                success: function (data) {
                    //console.log(data.bandera);
                    if (data.bandera) {
                        $("#infUser").removeClass("hidden");
                        $("#nombres").text(data.nombres);
                        $("#email").text(data.email);
                        $("#telefono").text(data.telefono);
                        if (data.ruta == null) {
                            $("#imagen").attr("src", "images/marcasDeAgua/marcaAgua.png");
                        } else {
                            $("#imagen").attr("src", "images/marcasDeAgua/" + data.ruta);
                        }
                    }


                },
                error: function () {
                    console.log('ok');
                }
            });
        }

    </script>
@endsection