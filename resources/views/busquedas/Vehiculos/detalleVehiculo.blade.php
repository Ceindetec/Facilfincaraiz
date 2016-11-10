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
        .det{
            margin-top: 0;
        }
        .sofaset-info{
            border-bottom: 1px solid black;
            margin: 0;
            padding: 0 0 2em 0;
        }
        .product-table {
            border-top: 0;
            padding-top: 0;
        }
        .item-sec h4{
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
            margin-top:0;
        }
        .m_2{
            margin-bottom: 1em;
        }
        #adicionales, .obj{
            padding: 0 15px;
        }
        textarea{
            resize: none;
        }
        .single-right h3{
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
        @media (min-width: 801px){
            .flexslider .slides > li {
                height: 180px !important;
            }
            .flexslider .slides img{
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
        @media (min-width: 992px){
            .rsidebar {
                margin: 0;
            }
            .sofaset-info{
                border-bottom: 0;
            }
            .obj{
                padding: 0 0px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="product-model">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('buscarVehiculos')}}">Vehiculos</a></li>
                <li class="active">Detallar</li>
            </ol>

            <div class="col-md-9 det">
                <div class="single_left">
                    <div class="flexslider">
                        <ul class="slides">
                            @foreach($publicacion->galeria as $galeria)
                                <li data-thumb="../images/publicaciones/{{$galeria->ruta}}" class="reducir">
                                    <img src="../images/publicaciones/{{$galeria->ruta}}" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="single-right">
                    <h3 class="conver">{{$publicacion->titulo}}</h3>
                    <i class="fa fa-map-marker"></i><span class="conver location"> {{$publicacion->municipio->municipio.", ".$publicacion->departamento}}</span>
                    {{--<div class="id"><h4>ID: SB2379</h4></div>--}}
                    {{--<form action="" class="sky-form">--}}
                        {{--<fieldset>--}}
                            {{--<section>--}}
                                {{--<div class="rating">--}}
                                    {{--<input type="radio" name="stars-rating" id="stars-rating-5">--}}
                                    {{--<label for="stars-rating-5"><i class="icon-star"></i></label>--}}
                                    {{--<input type="radio" name="stars-rating" id="stars-rating-4">--}}
                                    {{--<label for="stars-rating-4"><i class="icon-star"></i></label>--}}
                                    {{--<input type="radio" name="stars-rating" id="stars-rating-3">--}}
                                    {{--<label for="stars-rating-3"><i class="icon-star"></i></label>--}}
                                    {{--<input type="radio" name="stars-rating" id="stars-rating-2">--}}
                                    {{--<label for="stars-rating-2"><i class="icon-star"></i></label>--}}
                                    {{--<input type="radio" name="stars-rating" id="stars-rating-1">--}}
                                    {{--<label for="stars-rating-1"><i class="icon-star"></i></label>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</div>--}}
                            {{--</section>--}}
                        {{--</fieldset>--}}
                    {{--</form>--}}
                    <div class="cost">
                        <div class="prdt-cost">
                            <ul>
                                {{--<li>MRP: <del>Rs 55000</del></li>--}}
                                <li>Precio:</li>
                                <li class="active">$<span class="number">{{$publicacion->precio}}</span></li>
                                <a href="#">CONTACTAR</a>
                            </ul>
                        </div>
                        {{--<div class="check">--}}
                            {{--<p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Enter pin code for delivery & availability</p>--}}
                            {{--<form class="navbar-form navbar-left" role="search">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="text" class="form-control" placeholder="Enter Pin code">--}}
                                {{--</div>--}}
                                {{--<button type="submit" class="btn btn-default">Verify</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                    {{--<div class="item-list">--}}
                        {{--<ul>--}}
                            {{--<li>Material: Silver,Gold</li>--}}
                            {{--<li>Color: Red</li>--}}
                            {{--<li>Type: Earring & Pendant Set</li>--}}
                            {{--<li>Brand: American Diamond</li>--}}
                            {{--<li><a href="#">Click here for more details</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <div class="single-bottom1">
                        <h6>Detalles</h6>
                        <p class="prod-desc">{!!$publicacion->descripcion!!}</p>
                    </div>
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
                                <td><p>{{$publicacion->vehiculo->tipo}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Marca</p></td>
                                <td><p>{{$publicacion->vehiculo->marca}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Modelo</p></td>
                                <td><p>{{$publicacion->vehiculo->modelo}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Kilometraje</p></td>
                                <td><p><span class="number">{{$publicacion->vehiculo->kilometraje}}</span></p></td>
                            </tr>
                            <tr class="moto">
                                <td><p>Cilindraje</p></td>
                                <td><p><span class="number">{{$publicacion->vehiculo->cilindraje}}</span></p></td>
                            </tr>
                            <tr>
                                <td><p>Color</p></td>
                                <td><p><span class="conver">{{$publicacion->vehiculo->color}}</span></p></td>
                            </tr>
                            <tr class="carro">
                                <td><p># Puertas</p></td>
                                <td><p>{{$publicacion->vehiculo->cant_puertas}}</p></td>
                            </tr>
                            <tr>
                                <td><p>Combustible</p></td>
                                <td><p><span id="combustible"></span></p></td>
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
                <section  class="sky-form">
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
                                    {!!Form::email('correo', null, ['id'=>'correo','class'=>"form-control",'placeholder' => 'E-mail...', 'required'])!!}
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3">Teléfono:</label>
                                    {!!Form::text('telefono', null, ['id'=>'telefono','class'=>"form-control",'placeholder' => 'Telefono...', 'onkeypress' => 'return justNumbers(event)', 'required'])!!}
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3">Mensaje:</label>
                                    {!!Form::textarea('mensaje', null, ['id'=>'mensaje','class'=>"form-control",'placeholder' => 'Escibe tu mensaje al vendedor...', 'rows'=>4, 'maxlength'=>500, 'required'])!!}
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-default">Enviar</button>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                        </div>
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Tipo: </b>{{$publicacion->vehiculo->tipo}}</li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Marca: </b>{{$publicacion->vehiculo->marca}}</li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Modelo: </b>{{$publicacion->vehiculo->modelo}}</li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Kilometraje: </b><span class="number">{{$publicacion->vehiculo->kilometraje}}</span></li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="moto">--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Cilindraje: </b><span class="number">{{$publicacion->vehiculo->cilindraje}}</span></li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Color: </b><span class="conver">{{$publicacion->vehiculo->color}}</span></li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="carro">--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b># Puertas: </b>{{$publicacion->vehiculo->cant_puertas}}</li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<ul class="place">--}}
                                {{--<li class="sort"><b>Combustible: </b><span id="combustible"></span></li>--}}
                                {{--<div class="clearfix"> </div>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
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
        $(function(){
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
            $(".conver").each(function(){
                $(this).html(ucWords($(this).html()));
            });
            $(".number").each(function(){
                $(this).html(enmascarar($(this).html()));
            });
            $("#adicionales").append(cargarAdicionales());
            validarTipo();
        });

        function validarTipo(){
            var tipo = '{{$publicacion->vehiculo->tipo}}';
            $("#combustible").html(traducirCombustible('{{$publicacion->vehiculo->combustible}}'));
            if (tipo == 'Moto' || tipo == 'Moto-Carro' || tipo == 'Cuatrimoto')
                $(".carro").addClass("hidden");
            else
                $(".moto").addClass("hidden");

        }

        function cargarAdicionales(){
            var adicionales = '{{$publicacion->vehiculo->adicionales}}';
            var arrayAdicionales = adicionales.split(',');
            adicionales = '';
            var columna = (Math.ceil(arrayAdicionales.length/3) == 3)?4:6;
            for (var i=0; i<Math.ceil(arrayAdicionales.length/3); i++){
                adicionales = adicionales + '<div class="col-xs-12 col-sm-'+columna+' col-md-'+columna+' col-lg-'+columna+'"><ul>';
                for(var j=i*3; j<(i*3)+3; j++){
                    var traducido = traducirAdicional(arrayAdicionales[j]);
                    if (traducido != '')
                        adicionales = adicionales + '<li>' + traducido + '</li>';
                }
                adicionales = adicionales + '</ul></div>'
            }
            return adicionales;
        }

        function traducirAdicional(valor){
            var traducido = '';
            switch (valor){
                case 'edicion_especial':
                    traducido = 'Edición Especial';
                    break;
                case 'aire_acondicionado':
                    traducido = "Aire Acondicionado";
                    break;
                case 'air_bags':
                    traducido = "Air Bags";
                    break;
                case 'full_equipo':
                    traducido = "Full Equipo";
                    break;
                case 'planta_de_sonido':
                    traducido = "Planta de Sonido";
                    break;
                case 'convertible':
                    traducido = "Convertible";
                    break;
                case 'alarma':
                    traducido = "Alarma";
                    break;
                case 'bloqueo_central':
                    traducido = "Bloqueo Central";
                    break;
                case 'vidrios_electricos':
                    traducido = "Vidrios Eléctricos";
                    break;
            }
            return traducido;
        }

        function traducirCombustible(nombre){
            traducido = '';
            switch (nombre){
                case 'Gal':
                    traducido = "Gasolina";
                    break;
                case 'vidrios_electricos':
                    traducido = "Vidrios Eléctricos";
                    break;
                case 'Gas':
                    traducido = "Gas";
                    break;
                case 'D':
                    traducido = "Diesel";
                    break;
                case 'E':
                    traducido = "Electrico";
                    break;
                case 'GG':
                    traducido = "Gasolina y Gas";
                    break;
                case 'GE':
                    traducido = "Gasolina y Electrico";
                    break;
            }
            return traducido;
        }
    </script>
@endsection

