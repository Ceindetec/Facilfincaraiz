@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/ceindetecFileInput/css/ceindetecFileInput.css')!!}
    <style>
        .popover-content {
            width: 125px;
        }
        #map {
            width: 100%;
            height: 200px;

        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            cursor: pointer;

        }
        #galeria{
            margin: 20px 0px;
        }
        .imagen{
            border-radius: 5px;
            cursor: pointer;
        }
        .conteEliminar{
            position: relative;
            margin-top: -29px;
            margin-right: 20px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #d8d7dc;
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


        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 100000; /* Sit on top */
            padding-top: 10%; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            position: relative;
            margin: auto;
            display: block;
            z-index: 100001;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .cerrar {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .cerrar:hover,
        .cerrar:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>

@endsection

@section('content')
    <!---->

    <div class="row">
        <div class="col-xs-12" style="margin-bottom: 30px">
            <h2 class="text-center h2Josefin"> Publicar Un Terreno </h2>
        </div>
    </div>

    <div class="bride-grids">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="h3Josefin text-center">Informacón del Usuario</h3></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="col-xs-2 text-right"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <div class="col-xs-10">{{$user->nombres." ".$user->apellidos}}</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-xs-2 text-right"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                    <div class="col-xs-10">{{$user->telefono}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="col-xs-2 text-right"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    <div class="col-xs-10">{{$user->email}}</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>




            {!!Form::model($data,['id'=>'formTerreno','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                        <div class="col-sm-10">
                            {!!Form::text('titulo',null,['class'=>'form-control','placeholder'=>"Titulo", 'required'])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <h3 class="h3Josefin text-center" style="margin-bottom: 20px;">Las Imagenes de la publicación son.</h3>

                    <div id="galeria" class="row">
                        @foreach($imagenes as $imagene)

                            <div  id="{{$imagene->id}}" class="col-xs-6 col-sm-4 col-md-3">
                                <img src="../images/publicaciones/{{$imagene->ruta}}" class="img-responsive imagen" alt="">

                                <div class="conteEliminar">
                                    <i data-id="{{$imagene->id}}" class="fa fa-trash eliminarImage" aria-hidden='true' data-toggle='confirmation' data-popout="true" data-placement='top' title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                </div>

                            </div>


                        @endforeach

                    </div>

                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Imagenes</label>
                        <div class="col-sm-10">
                            <input type="file" id="files" name="files[]"  multiple />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="tipo_id" class="col-sm-4 control-label">Categorias</label>
                        <div class="col-sm-8">
                            {!!Form::select('tipo_id',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Seleccione una categoria'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="accion" class="col-sm-4 control-label">Acción</label>
                        <div class="col-sm-8">
                            {!!Form::select('accion',['V'=>'Vender','A'=>'Arrendar','P'=>'Permutar'], null, ['class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="precio" class="col-sm-4 control-label">Precio</label>
                        <div class="col-sm-8">
                            {!!Form::text('precio',null,['class'=>'form-control','placeholder'=>"precio del inmueble", 'required' , 'onkeypress'=>'return justNumbers(event)'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="estrato" class="col-sm-4 control-label">Estrato</label>
                        <div class="col-sm-8">
                            {!!Form::select('estrato',['1'=>'Estrato 1','2'=>'Estrato 2','3'=>'Estrato 3','4'=>'Estrato 4','5'=>'Estrato 5','6'=>'Estrato 6'], null, ['class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Dimensiones</h3>
            </div>


            <div class="row" id="rowDimenciones">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="frente" class="col-sm-4 control-label">Frente (m)</label>
                        <div class="col-sm-8">
                            {!!Form::text('frente',null,['id'=>'frente','class'=>'form-control','placeholder'=>"metros de frente"])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fondo" class="col-sm-4 control-label">Fondo (m)</label>
                        <div class="col-sm-8">
                            {!!Form::text('fondo',null,['id'=>'fondo','class'=>'form-control','placeholder'=>"metros de fondo"])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="area" class="col-sm-4 control-label">Area total</label>
                        <div class="col-xs-8 col-sm-6">
                            {!!Form::text('area',null,['id'=>"area",'class'=>'form-control','placeholder'=>"area total metros cuadrados"])!!}
                        </div>
                        <div class="col-xs-4 col-sm-2">
                            {!!Form::select('umedida', ['m'=>'m2','h'=>'hta'], null, ['class'=>"form-control",'id'=>"umedida"])!!}
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Ubicación</h3>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" style="margin-top: 20px;">
                        {!! Form::label('id_dpto', 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('id_dpto', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento'])!!}
                        </div>
                    </div>
                    <div class="form-group" id="divMinucipio">
                        {!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="col-sm-4 control-label">Dirección</label>
                        <div class="col-sm-8">
                            {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>"calle 24A No.15 - 30",])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="geolocalizacion" class="col-sm-4 control-label">Geolocalización</label>
                        <div class="col-sm-8">
                            {!!Form::text('geolocalizacion',null,['class'=>'form-control','id'=>'geolocalizacion','disabled'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="color:#00a0dc; margin-bottom: 20px;">

                    <div id="map"></div>
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    arrastra el marcador a la posición deseada

                </div>
            </div>

            <div id="tituloAdicionales" class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Caracteristicas Adicionales</h3>
            </div>


            <div id="adicionales" class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'agua') !!} Agua
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'luz') !!} Luz
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'gas') !!} Gas
                                </label>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'conjunto_cerrado') !!} Conjunto Cerrado
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'condominio') !!} Condominio
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinales[]', 'proyecto_de_vivienda') !!} Terreno para proyecto de vivienda
                                </label>
                            </div>
                        </div></div>
                </div>
            </div>

            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Descripción general</h3>
            </div>


            <div class="row">
                <textarea id='infoAdicional' name='infoAdicional' rows='10' cols='30' style='height:440px'>{{$data["descripcion"]}}</textarea>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1" id="error"></div>
            </div>

            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Acciones de Administrador </h3>
                </div>
                <div class="panel-body">
                    <div class="col-sm-8">
                        <div class="form-group" id="divMinucipio">
                            {!! Form::label('estado', 'Estado de la Publicación',['class'=>'col-sm-6 control-label']) !!}
                            <div class="col-sm-6">
                                {!!Form::select('estado', ["P"=>"Pendiente","A"=>"Activa","I"=>"Inactiva"], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('destacado', 'x') !!} Publicación Destacada
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-offset-2 col-sm-8">
                    <div id="alert">


                    </div>
                </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="mybutton center-block" id="submit">Publicar</button>
                </div>
            </div>
            </form>

        </div>
    </div>
    <!---->
@endsection

@section('scripts')
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('http://maps.google.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&sensor=true')!!}
    {!!Html::script('https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js')!!}
    {!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}
    {!!Html::script('js/gmaps.js')!!}
    <script charset="utf-8">
        var map;
        var geolocalizacion;
        var banderaMunu = true;
        $(function(){
            $("#liPublicaciones").addClass("active");
            $(".eliminarImage").each(function(){
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).data("id"));
                        //console.log($(this).data("id"));
                        //$("#"+$(this).data("id")).remove();
                    }
                });
            });

            geolocalizacion="{{$data["geolocalizacion"]}}";
            $(".imagen").click(function () {
                $('#myModal').css("display","block");
                // modal.style.display = "block";
                $("#img01").attr( "src", this.src );
                //modalImg.src = this.src;
                //captionText.innerHTML = this.alt;
            });
            $(".close").click(function () {
                $('#myModal').css("display","none");
            });
            $("#myModal").click(function () {
                $('#myModal').css("display","none");
            });

            var adicionales= "{{$data["adicionales"]}}";

            var arrayAdicionales;
            arrayAdicionales = adicionales.split(",");
            //console.log(adicionales);

            $("input:checkbox").each(function(index,check){
                // console.log($(check).val());
                $.each(arrayAdicionales, function( item, value ) {
                    if($(check).val()==value){
                        $(check).prop('checked', true);
                    }
                });
            });
            $("#files").inputFileImage({
                maxlength:8,
                width:120,
                height: 140,
                maxfilesize:1024
            });


            CKEDITOR.replace('infoAdicional', {removeButtons:'Image'});
            $("#tipoArticulo").change(function(){
                console.log($(this).val());
            });


            $("#id_dpto").change(function () {

                if($("#id_dpto").val()==""){
                    //alert("el id es nulo");
                    $("#municipio_id").empty();
                    $("#municipio_id").append("<option value=''>Selecciona un Municipio</option>");
                }else{
                    //alert("el id es "+$("#id_dpto").val());
                    $.ajax({
                        type: "POST",
                        context: document.body,
                        url: '{{route('municipios')}}',
                        data: { 'id' : $("#id_dpto").val()},
                        success: function (data) {

                            $("#municipio_id").empty();

                            $.each(data,function (index,valor) {
                                $("#municipio_id").append('<option value='+index+'>'+valor+'</option>');
                            });
                            if(banderaMunu){
                                $("#municipio_id").val({{$data["municipio_id"]}});
                                banderaMunu = false;
                            }
                        },
                        error: function (data) {
                        }
                    });
                }

            });


            map = new GMaps({
                el: '#map',
                lat: -12.043333,
                lng: -77.028333
            });
            if(geolocalizacion!=""){

                corde= geolocalizacion.split(",");
                //console.log(corde[0]);
                map.setCenter(corde[0], corde[1]);
                map.removeMarkers();
                map.addMarker({
                    lat: corde[0],
                    draggable: true,
                    lng: corde[1],
                    dragend: function(e) {
                        var lat = e.latLng.lat();
                        var lng = e.latLng.lng();
                        map.setCenter(lat, lng);
                        document.getElementById("coords").value = lat+","+ lng;
                        //alert('dragend '+lat+"->"+lng);
                        //console.log(e);
                    }
                });
            }

            $("#umedida").change(function () {
                console.log($(this).val());
                if($(this).val()=='m'){
                    if($("#area")==""){
                        $("#area").attr('placeholder','area total en metros cuadrados');
                    }else {
                        var valor =$("#area").val();
                        $("#area").val(valor*10000);
                        //console.log(valor+"->"+($("#area").val()*10000)+" ->" +($("#area").val())*10000);
                        // $("#area").val();
                    }

                }else{
                    if($("#area")=="") {
                        $("#area").attr('placeholder','area total en Hectareas');
                    }else{
                        var valor =$("#area").val();
                        $("#area").val(parseFloat(valor/10000));
                        //console.log(valor+"->"+($("#area").val()/10000)+" ->" +parseFloat($("#area").val()/10000));
                        //$("#area").val(Math.floor($("#area").val()/10000));
                    }

                }
            });


            $("#categorias").change(function () {

                $("#tituloAdicionales").removeClass("hidden");
                $("#adicionales").removeClass("hidden");

                if($("#categorias option:selected").text()=='Grandes terrenos'){
                    $("#rowDimenciones").addClass("hidden");
                }else{
                    $("#rowDimenciones").removeClass("hidden");
                    if($("#categorias option:selected").text()=='Parcelas cementerios'){
                        $("#tituloAdicionales").addClass("hidden");
                        $("#adicionales").addClass("hidden");
                    }
                }
            });

            $("#frente").change(function () {
                if(($(this).val()!=""&&$(this).val()>0)&&($("#fondo")!=""&&$("#fondo").val()>0)){
                    console.log($(this).val()*$("#fondo").val());
                    $("#area").val($(this).val()*$("#fondo").val());
                    $("#umedida").val("m");
                }
            });

            $("#fondo").change(function () {
                if(($(this).val()!=""&&$(this).val()>0)&&($("#frente")!=""&&$("#frente").val()>0)){
                    console.log($(this).val()*$("#frente").val());
                    $("#area").val($(this).val()*$("#frente").val());
                    $("#umedida").val("m");
                }
            });

            var formulario = $("#formTerreno");
            formulario.submit(function(e){
                e.preventDefault();
                //var contenido = encodeURIComponent(CKEDITOR.instances.infoAdicional.getData().split("\n").join(""));
                var contenido = CKEDITOR.instances.infoAdicional.getData().split("\n").join("");
                //console.log($("#files").data("files"));
                var formData = new FormData($(this)[0]);

                var files = $("#files").data("files");
                if(files)
                for(i=0;i<files.length;i++){
                    formData.append("imagenes[]", files[i]);
                }
                formData.append("id", "{{$data["id"]}}");
                formData.append("descripcion", contenido);
                formData.append("geolocalizacion", $("#geolocalizacion").val());

                $.ajax({
                    url: "{!! route('subirPublic') !!}",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (result) {
                        if(result.estado){
                            $("#submit").attr("disabled", true);
                            alert("success","Perfecto","La publicación fue publicada con exito","<i class='fa fa-check' aria-hidden='true'></i>");
                            setTimeout(function(){
                                window.location="../publicPendientes";
                            }, 3000);
                        }else{
                            alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                        }

                    },
                    error: function (error) {
                        alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                        console.log(error);
                    }
                });

            });
            $("#categorias").trigger("change");
            $("#id_dpto").trigger("change");
        });

        function justNumbers(e)
        {
            var keynum = window.event ? window.event.keyCode : e.which;
            if (keynum == 8)
                return true;
            return /\d/.test(String.fromCharCode(keynum));
        }
        function alert(tipo,titulo,mensaje,icono) {
            $("#alert").empty();
            var html ="<div class='alert alert-"+tipo+"'>"+
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
                    icono+"<strong>"+titulo+"!</strong> "+mensaje+
                    "</div>";
            $("#alert").append(html)
        }
        function  ajaxEliminarImagen(id) {
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route('deleteImgPublic')}}',
                data: {"id":id},
                success: function(data){
                    if (data == "exito"){
                        $("#"+id).remove();
                    }
                },
                error: function(data){
                }
            });
        }
    </script>
    <div id="myModal" class="modal">
        <span class="cerrar">×</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
@endsection