@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins\jQueryUI\jquery-ui.css')!!}
    {!!Html::style('plugins/ceindetecFileInput/css/ceindetecFileInput.css')!!}

    <style>
        .popover-content {
            width: 125px;
        }
        .mybutton {
            padding: 6px 10px;
        }
        .conteEliminar{
            position: relative;
            margin-top: -15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #d8d7dc;
            left: 135px;
        }

        .eliminarImage{
            font-size: 16px;
            margin: 8px 8px;
            cursor: pointer;
        }

        .eliminarImage:hover{

            color: #81161a;
            margin: 8px 8px;
        }
        .contemarca{
            border: solid 1px;
            padding: 3px;
            border-radius: 3px;
        }
        .divConteMarcaDA {
            width: 125px;
            margin: 10px auto;
        }

        .userEmail{
            cursor: pointer;
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
                                                <div style="width: 150px;margin: 10px auto">
                                                    <div class="contemarca">
                                                        <img src="images/marcasDeAgua/marcaAgua.png"class="img-responsive imagen" id="imagen" alt="">
                                                    </div>
                                                    <div class="conteEliminar">
                                                        <i id="iEliminar" data-id="" class="fa fa-trash eliminarImage" aria-hidden='true' data-toggle='confirmation' data-popout="true" data-placement='top' title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                                    </div>
                                                </div>
                                                marca de Agua
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-xs-12">
                                                {!!Form::open(['id'=>'formMarcadeAgua','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}

                                                <div class="form-group">
                                                    <label for="titulo" class="col-sm-4 control-label">Cargar Marca de Agua</label>
                                                    <div class="col-sm-6" id="divImagen">
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
        </div>
        <div class="col-sm-12 ">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios con marcas de Agua</h3>
                    </div>
                    <div class="panel-body" id="usuariosMarcaDA">

                        <div class="row">
                            @foreach($marcaDA as $item)
                                <div class="col-sm-6">
                                    <div class="panel panel-default userEmail" data-email="{{$item->getUsuario->email}}">
                                        <div class="panel-body">
                                            <div class="col-md-4 text-center">
                                                <div class="divConteMarcaDA">
                                                    <div class="contemarca">
                                                        <img src="images/marcasDeAgua/{{$item->ruta}}"
                                                             class="img-responsive imagen" id="imagen" alt=""
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-user"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="nombres"> {{$item->getUsuario->nombres." ".$item->getUsuario->apellidos}}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-phone"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="telefono"> {{$item->getUsuario->telefono}}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-2 text-right"><i class="fa fa-envelope"
                                                                                        aria-hidden="true"></i></div>
                                                    <div class="col-xs-10" id="email"> {{$item->getUsuario->email}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="row text-center">
                            {!! $marcaDA->render() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    >
    <!---->
@endsection

@section('scripts')
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('plugins\jQueryUI\jquery-ui.min.js')!!}
    {!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}
    <script>
        var page;
        var email;
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $(".eliminarImage").each(function(){
                $(this).confirmation({
                    onConfirm: function () {
                        //console.log($(this).data("id"));
                        ajaxEliminarImagen($(this).data("id"));
                    }
                });
            });
            $("#files").inputFileImage({
                maxlength: 1,
                width: 120,
                height: 140,
                minWidthImage: 300,
                minHeightImage: 100,
                maxWidthImage:400,
                maxHeightImage:200,
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

                var formData = new FormData($(this)[0]);
                var files = $("#files").data("files");
                for(i=0;i<files.length;i++){
                    formData.append("imagenes[]", files[i]);
                }
                formData.append("email", email);

                $.ajax({
                    url: "{!! route('subirMarcaDA') !!}",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (result) {
                                //console.log(result.estado);
                        if(result.estado){
                            $("#divImagen").html('<input type="file" id="files" name="files[]" multiple required style="width: 200px; height: 35px;"/>');
                            $("#files").inputFileImage({
                                maxlength: 1,
                                width: 120,
                                height: 140,
                                minWidthImage: 300,
                                minHeightImage: 100,
                                maxWidthImage:400,
                                maxHeightImage:200,
                                minType: ["png"],
                                maxfilesize: 1024
                            });
                            traerInfUsuer(email);
                            llamarPageAjax(page);
                        }else{

                        }

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });


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
                        email=data.email;
                        $("#infUser").removeClass("hidden");
                        $("#nombres").text(data.nombres);
                        $("#email").text(data.email);
                        $("#telefono").text(data.telefono);
                        if (data.ruta == null) {
                            $(".conteEliminar").addClass("hidden");
                            $("#imagen").attr("src", "images/marcasDeAgua/marcaAgua.png");
                        } else {
                            $(".conteEliminar").removeClass("hidden");
                            $("#imagen").attr("src", "images/marcasDeAgua/" + data.ruta);
                            $("#iEliminar").data("id",data.id_ruta);
                        }
                    }


                },
                error: function () {
                    console.log('ok');
                }
            });
        }

        function  ajaxEliminarImagen(id) {
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route('eliminaMarcaDA')}}',
                data: {"id":id},
                success: function(data){
                    if (data.estado) {
                        traerInfUsuer(email);
                        llamarPageAjax(page);
                    }
                },
                error: function(data){
                }
            });
        }

        $(document).on("click",".pagination a", function (e) {
            e.preventDefault();

            page = $(this).attr("href").split("page=")[1];

            llamarPageAjax(page);

        });

        function llamarPageAjax(page) {
            $.ajax({
                type:"GET",
                context: 'json',
                url: '{{route('marcaDeAgua')}}',
                data: {page:page},
                success: function(data){
                    $("#usuariosMarcaDA").html(data);
                },
                error: function(data){
                }
            });
        }

        $("#usuariosMarcaDA").on("click",".userEmail",function () {
            traerInfUsuer($(this).data("email"));
        });

    </script>
@endsection