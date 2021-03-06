                                                                                                                                                                                                                                                                                                                                                                                     @extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
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
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}">Inicio</a></li>
        <li class="active">Validar Publicacion Vehiculo</li>
    </ol>

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
            {!!Form::model($data,['id'=>'formVehiculo','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}





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
                            {!!Form::select('tipo_id',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Seleccione una categoria', 'required'])!!}
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
                        <label for="valor" class="col-sm-4 control-label">Precio</label>
                        <div class="col-sm-8">
                            {!!Form::text('precio',null,['class'=>'form-control','placeholder'=>"precio del inmueble", 'required' , 'onkeypress'=>'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onchange"=>"format(this)"])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" id="col-cilindraje">
                    <div class="form-group">
                        <label for="cilindraje" class="col-sm-4 control-label">Cilindaje</label>
                        <div class="col-sm-8">
                            {!!Form::select('cilindraje',['1'=>'0 a 99 cc','2'=>'100 a 199 cc','3'=>'200 a 299 cc','4'=>'300 a 399 cc','5'=>'400 a 699 cc','6'=>'700 a 999 cc','7'=>'1000 a 1299 cc','8'=>'más de 1300 cc'], null, ['id'=>'cilindraje','class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 hidden" id="col-numPuertas">
                    <div class="form-group">
                        <label for="cant_puertas" class="col-sm-4 control-label">Número Puertas</label>
                        <div class="col-sm-8">
                            {!!Form::select('cant_puertas',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['id'=>'cant_puertas','class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="marca_id" class="col-sm-4 control-label">Marca</label>
                        <div class="col-sm-8">
                            {!!Form::select('marca_id',[], null, ['id'=>'marca_id','class'=>"form-control",'placeholder' => 'Seleccione una marca'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('modelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                {!!Form::text('modelo',null,["id"=>"modelo",'class'=>'form-control pull-right', 'readonly','required'])!!}
                                {{--<input type="text" name="modelo" class="form-control pull-right" id="modelo" placeholder="Selecciona una fecha..." readonly required>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="kilometraje" class="col-sm-4 control-label">Kilometraje</label>
                        <div class="col-sm-8">
                            {!!Form::text('kilometraje',null,['class'=>'form-control','placeholder'=>"precio del inmueble", 'onkeypress'=>'return justNumbers(event)'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="color" class="col-sm-4 control-label">Color</label>
                        <div class="col-sm-8">
                            {!!Form::text('color',null,['id'=>'color','class'=>'form-control','placeholder'=>"precio del inmueble", 'required'])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="combustible" class="col-sm-4 control-label">Combustible</label>
                        <div class="col-sm-8">
                            {!!Form::select('combustible',['Gal'=>'Gasolina','Gas'=>'Gas','D'=>'Diesel','E'=>'Electrico','GG'=>'Gasolina y Gas','GE'=>'Gasolina y Electrico'], null, ['id'=>'combustible','class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="tipo_caja" class="col-sm-4 control-label">Tipo de Caja</label>
                        <div class="col-sm-8">
                            {!!Form::select('tipo_caja',['M'=>'Mecanica','S'=>'Semiautomatica','A'=>'Automatica'], null, ['class'=>"form-control"])!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Ubicación</h3>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('id_dpto', 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('id_dpto', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento'])!!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group" id="divMinucipio">
                        {!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio'])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="direccion" class="col-sm-4 control-label">Dirección</label>
                        <div class="col-sm-8">
                            {!!Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>"calle 24A No.15 - 30"])!!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Caracteristicas Adicionales</h3>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'edicion_especial') !!} Edicion Especial
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'aire_acondicionado') !!} Aire Acondicionado
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'air_bags') !!} Air Bags
                        </label>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'full_equipo') !!} Full equipo
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'planta_de_sonido') !!} Planta de sonido
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'convertible') !!} Convertible
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'alarma') !!} Alarma
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'bloqueo_central') !!} Bloqueo Central
                        </label>
                    </div>
                    <div class="checkbox noMoto">
                        <label>
                            {!! Form::checkbox('adicinales[]', 'vidrios_electricos') !!} Vidrios Electricos
                        </label>
                    </div>
                </div>
            </div>

            <div class="row" style="margin: 15px 0">
                <h3 class="h3Josefin text-center">Descripción general</h3>
            </div>


            <div class="row">
                <textarea id='descripcion' name='descripcion' rows='10' cols='30' style='height:440px'>{{$data["descripcion"]}}</textarea>
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



</div>
<!---->
@endsection

@section('scripts')
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    {!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    {!!Html::script('js/gmaps.js')!!}
    <script charset="utf-8">
        var bandera=true;
        var banderaMunu=true;

        $(function(){
            $("#liPublicaciones").addClass("active");
            $(".eliminarImage").each(function(){
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).data("id"));
                    }
                });
            });

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

            CKEDITOR.replace('descripcion', {removeButtons:'Image'});
            $("#tipoArticulo").change(function(){
                console.log($(this).val());
            });

            $.fn.datepicker.dates['es'] = {
                days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                today: "Hoy",
                clear: "Clear",
                format: "yyyy/mm/dd",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };
            $('#modelo').datepicker({
                autoclose: true,
                format: "yyyy",
                startView: "year",
                minView: "year",
                minViewMode: "years",
                language: 'es',
                endDate:''+(new Date().getFullYear()+1)
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

                                //console.log("la key es "+index+" y el valor es "+valor);
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

            $("#categorias").change(function () {
                //console.log($("#categorias option:selected").text());
                if($("#categorias option:selected").text()=='Moto'||$("#categorias option:selected").text()=='Moto-Carro'||$("#categorias option:selected").text()=='Cuatrimoto'){

                    $("#col-numPuertas").addClass("hidden");
                    $("#col-cilindraje").removeClass("hidden");
                    $(".noMoto").addClass("hidden");
                    llenarMarca("M");
                }else{
                    $("#col-cilindraje").addClass("hidden");
                    $("#col-numPuertas").removeClass("hidden");
                    $(".noMoto").removeClass("hidden");
                    llenarMarca("C");

                }
            });

            var formulario = $("#formVehiculo");
            formulario.submit(function(e){
                e.preventDefault();
                //var contenido = encodeURIComponent(CKEDITOR.instances.descripcion.getData().split("\n").join(""));
                var contenido = CKEDITOR.instances.descripcion.getData().split("\n").join("");
                //console.log($("#files").data("files"));
                var formData = new FormData($(this)[0]);
                var files = $("#files").data("files");
                if(files)
                for(i=0;i<files.length;i++){
                    formData.append("imagenes[]", files[i]);
                }
                formData.append("id", "{{$data["id"]}}");
                formData.append("descripcion", contenido);

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

        function llenarMarca(tipo) {

            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('marcas')}}',
                data: { 'tipo' : tipo},
                success: function (data) {
                    $("#marca_id").empty();
                    $.each(data,function (index,valor) {
                        $("#marca_id").append('<option value='+index+'>'+valor+'</option>');
                    });
                    if(bandera){
                        $("#marca_id").val({{$data["marca_id"]}});
                        bandera = false;
                    }

                },
                error: function (data) {
                }
            });
        }

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