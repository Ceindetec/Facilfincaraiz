@extends('layouts.principal')

@section('style')
    {!!Html::style('css/flexslider.css')!!}
    <style>
        .flex-control-thumbs img {
            padding: 5%;
        }

        .flexslider .slides img {
            margin: 0 auto;
            height: 100%;
        }

        .flexslider {
            margin: 0 0 20px;
        }

        .sofaset-info {
            margin: 1em 0;
        }

        .single-bottom1 h6 {
            margin-top: 1.5em;
        }

        .sofaset-info h4 {
            margin-bottom: 0.5em;
        }

        .det {
            margin-top: 0;
        }

        .sofaset-info {
            border-bottom: 1px solid black;
            margin: 0;
            padding: 0 0 2em 0;
        }

        .product-table {
            border-top: 0;
            padding-top: 0;
        }

        .item-sec h4 {
            margin-top: 0;
        }

        ul.place li {
            padding: 4px 6px;
        }

        ul.place li span, .location {
            color: #8c8c8c;;
        }

        .item-sec {
            padding: 1em 0 2em 0;
            margin-top: 0;
        }

        .m_2 {
            margin-bottom: 1em;
        }

        #adicionales, .obj {
            padding: 0 15px;
        }

        textarea {
            resize: none;
        }

        .single-right h3 {
            margin-bottom: 0.2em;
        }

        @media (max-width: 480px) {
            .flexslider .slides > li {
                height: 200px !important;
            }
        }

        @media (min-width: 481px) and (max-width: 800px) {
            .flexslider .slides > li {
                height: 180px !important;
            }

            .rsidebar {
                padding-left: 15px;
                padding-right: 3em;
            }
        }

        @media (min-width: 801px) {
            .flexslider .slides > li {
                height: 180px !important;
            }

            .flexslider .slides img {
                padding: 0 15px;
                margin: 0 auto;
            }
        }

        @media (min-width: 801px) and (max-width: 991px) {
            .rsidebar {
                padding-left: 15px;
                padding-right: 3em;
            }
        }

        @media (min-width: 992px) {
            .rsidebar {
                margin: 0;
            }

            .sofaset-info {
                border-bottom: 0;
            }

            .obj {
                padding: 0 0px;
            }
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
        .imagen{
            cursor: zoom-in;
        }



    </style>
@endsection

@section('content')
    <div class="product-model">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('buscarInmuebles')}}">Inmuebles</a></li>
                <li class="active">Detallar</li>
            </ol>

            <div class="col-md-9 det">
                <div class="single_left">
                    <div class="flexslider">
                        <ul class="slides">
                            @foreach($publicacion->galeria as $galeria)
                                <li data-thumb="../images/publicaciones/{{$galeria->ruta}}" class="reducir">
                                    <img class="imagen" src="../images/publicaciones/{{$galeria->ruta}}"/>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="single-right">
                    <h3 class="conver">{{(($publicacion->accion=="V")?"En venta ":(($publicacion->accion=="A")?"Se Arrienda ":"Se  alquila "))}}</h3>
                    <h3 class="conver">{{$publicacion->titulo}}</h3>
                    {{--<h3 class="conver">{{(($publicacion->accion=="V")?"(Venta) ":(($publicacion->accion=="A")?"(Arriendo) ":"(Alquiler) ")).$publicacion->titulo}}</h3>--}}
                    <i class="fa fa-map-marker"></i><span
                            class="conver location"> {{$publicacion->municipio->municipio.", ".$publicacion->departamento}}</span>
                    <div class="cost">
                        <div class="prdt-cost">
                            <ul>
                                <li>Precio:</li>
                                <li class="active">$<span class="number">{{$publicacion->precio}}</span></li>
                                <a href="#" id="contactar">CONTACTAR</a>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="single-bottom1">
                    <h6>Detalles</h6>
                    <p class="prod-desc">{!!$publicacion->descripcion!!}</p>
                </div>
                <div class="clearfix"></div>
                <!---->
                <div class="product-table">
                    <div class="item-sec">
                        <h4>Especificaciónes</h4>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td><p>Tipo</p></td>
                                <td><p>{{$publicacion->inmueble->tipo}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Estrato</p></td>
                                <td><p>{{$publicacion->inmueble->estrato}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Frente</p></td>
                                <td><p><span class="number">{{$publicacion->inmueble->frente}}</span> metros</p></td>
                            </tr>
                            <tr>
                                <td><p>Fondo</p></td>
                                <td><p><span class="number">{{$publicacion->inmueble->fondo}}</span> metros</p></td>
                            </tr>
                            <tr>
                                <td><p>Area</p></td>
                                <td><p id="pArea" ></p></td>
                            </tr>
                            <tr class="terreno">
                                <td><p>Número de Plantas</p></td>
                                <td><p>{{$publicacion->inmueble->cant_plantas}}</p></td>
                            </tr>
                            <tr class="terreno">
                                <td><p>Número de Habitaciones</p></td>
                                <td><p>{{$publicacion->inmueble->cant_habitaciones}}</p></td>
                            </tr>
                            <tr class="terreno">
                                <td><p>Número de baños</p></td>
                                <td><p><span >{{$publicacion->inmueble->cant_banos}}</span></p></td>
                            </tr>
                            <tr class="terreno">
                                <td><p>Número de garajes</p></td>
                                <td><p><span >{{$publicacion->inmueble->cant_garajes}}</span></p></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="sofaset-info">
                    <h4>Características Adicionales</h4>
                    <div class="row" id="adicionales"></div>
                </div>
            </div>

            <div class="rsidebar span_1_of_left">
                <section class="sky-form">
                    <div class="product_right">
                        <h4 class="m_2"><span class="fa fa-comments" aria-hidden="true"></span> Contactar Vendedor</h4>
                        <div class="obj">
                            {!!Form::open(['id'=>'formContacto','autocomplete'=>'off'])!!}
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                {!!Form::text('nombre', null, ['id'=>'nombre','class'=>"form-control",'placeholder' => 'Tu nombre...', 'onkeypress' => 'return justletters(event)', 'required'])!!}
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Correo:</label>
                                {!!Form::email('email', null, ['id'=>'email','class'=>"form-control",'placeholder' => 'E-mail...', 'required'])!!}
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Teléfono:</label>
                                {!!Form::text('telefono', null, ['id'=>'telefono','class'=>"form-control",'placeholder' => 'Telefono...', 'onkeypress' => 'return justNumbers(event)', 'required'])!!}
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Mensaje:</label>
                                {!!Form::textarea('mensaje', null, ['id'=>'mensaje','class'=>"form-control",'placeholder' => 'Escibe tu mensaje al vendedor...', 'rows'=>4, 'maxlength'=>500, 'required'])!!}
                            </div>
                            <div id="alertContacto" class="form-group ">


                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
                                    <button class="btn btn-default" type="submit" id="submitForm">Enviar <i
                                                class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
                                        <span class="sr-only">Loading...</span></button>
                                </div>
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </section>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script('js/jquery.flexslider.js')!!}
    {!!Html::script('js/publicaciones.js')!!}
    <script>
        $(function () {

            var tipoInmueble= "{{$publicacion->tipo}}";

            if(tipoInmueble=="T")
                $(".terreno").addClass("hidden");

            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
            $(".conver").each(function () {
                $(this).html(ucWords($(this).html()));
            });
            $(".number").each(function () {
                $(this).html(enmascarar($(this).html()));
            });
            $("#adicionales").append(cargarAdicionales());
//            validarTipo();

            var formContacto = $("#formContacto");
            formContacto.submit(function (e) {
                e.preventDefault();
                $(".cargando").removeClass("hidden");
                //console.log(formContacto.serialize());
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('interesXpublicacion')}}',
                    data: formContacto.serialize()+"&ruta={{(($publicacion->tipo=="T")?"validarPublicTerreno/":"validarPublicInmueble/").$publicacion->id}}",
                    success: function (data) {
                        if (data == "exito") {
                            $(".cargando").addClass("hidden");
                            $("#alertContacto").empty();

                            html = '<div class="alert alert-success">' +
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Perfecto!</strong> el mensaje fue enviado' +
                                    '</div>';


                            $("#alertContacto").append(html);

                        }
                        else {
                            //alert("Se genero un error Interno");
                        }
                    },
                    error: function () {
                        console.log('ok');
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


            $("#contactar").click(function (e) {
                e.preventDefault();
                $( "#submitForm" ).trigger( "click" );
            });

           $("#pArea").html( valorArea({{$publicacion->inmueble->area}}));
        });

        function cargarAdicionales() {
            var adicionales = '{{$publicacion->inmueble->adicionales}}';
            var arrayAdicionales = adicionales.split(',');
            adicionales = '';
            var columna = (Math.ceil(arrayAdicionales.length / 3) == 3) ? 4 : 6;
            for (var i = 0; i < Math.ceil(arrayAdicionales.length / 3); i++) {
                adicionales = adicionales + '<div class="col-xs-12 col-sm-' + columna + ' col-md-' + columna + ' col-lg-' + columna + '"><ul>';
                for (var j = i * 3; j < (i * 3) + 3; j++) {
                    var traducido = traducirAdicional(arrayAdicionales[j]);
                    if (traducido != '')
                        adicionales = adicionales + '<li>' + traducido + '</li>';
                }
                adicionales = adicionales + '</ul></div>'
            }
            return adicionales;
        }

        function traducirAdicional(valor) {
            var traducido = '';
            switch (valor) {
                case 'agua':
                    traducido = 'Agua';
                    break;
                case 'luz':
                    traducido = "Luz";
                    break;
                case 'gas':
                    traducido = "Gas";
                    break;
                case 'alcantarillado':
                    traducido = "Alcantarillado";
                    break;
                case 'balcon':
                    traducido = "Balcon";
                    break;
                case 'terraza':
                    traducido = "Terraza";
                    break;
                case 'patio':
                    traducido = "Patio";
                    break;
                case 'cocina_integral':
                    traducido = "Cocina Integral";
                    break;
                case 'condominio':
                    traducido = "Condominio";
                    break;
                case 'proyecto_de_vivienda':
                    traducido = "Terreno para proyecto de vivienda";
                    break;
                case 'conjunto_cerrado':
                    traducido = "Conjunto Cerrado";
                    break;

            }
            return traducido;
        }

        function valorArea(valor) {
            if(parseInt(valor)>100000){
                var cadena=  (valor/10000)+"";
                araryNum = cadena.replace(".",",").split(",");
                return enmascarar(araryNum[0])+","+araryNum[1]+" ha";
            }else
                return enmascarar(valor) + " m<sup>2</sup>";
        }


    </script>



    <div id="myModal" class="modal">
        <span class="cerrar">×</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>


@endsection

