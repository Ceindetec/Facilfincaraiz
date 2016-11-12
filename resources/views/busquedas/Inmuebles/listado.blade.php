@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
    {!!Html::style('plugins\jQueryUI\jquery-ui.css')!!}
    <style>
        .filtro{
            padding-top: 8px;
            padding-bottom: 15px;
        }
        select, .ui-slider .ui-slider-handle{
            cursor: pointer;
        }
        .ui-widget-content{
            margin: 5px 0;
        }
        .form-control[readonly]{
            background-color: white;
        }
        .rsidebar {
            margin: 0 2em 0 0;
        }
        #modelo, #precio{
            cursor: default;
        }
        .izquierda{
            padding-right: 0;
        }
        .derecha{
            padding-left: 0;
        }
        .texto{
            padding: 6px 0
        }
        .puntero{
            cursor: pointer;
        }
        .confirm { transition: all .2s ease-in-out; }
        .confirm:hover { transform: scale(1.1); }

        .product-model-sec {
            margin: 0;
        }
        .tiraPublicacion{
            padding: 8px;
            /*margin-bottom: 4px;*/
            margin: 0 8px 4px 8px;
        }
        .conteFoto{
            height: 180px;
        }
        .foto{
            height: 100%;
        }
        .bordered{
            border: solid 2px #f5f5f5;
        }
        .ubic{
            color: #8c8c8c;
        }
        @media (max-width: 600px) {
            .conteFoto {
                padding: 0;
                height: 130px;;
            }

            .tiraPublicacion {
                margin: 0 0 4px 0;
            }

            #seccionResultados {
                padding: 0;
            }
        }
        .tiraPublicacion { transition: all .2s ease-out; }
        .tiraPublicacion:hover { box-shadow: 1px 3px 10px #373737;transform: scale(1.05); }
        .destacado{
            background: #e8573e;
            color: white;
            margin-bottom: 7px;
            max-width: 200px;
            min-width: 120px;
        }
        .precio{
            color:#e8573e;
        }
        .marginBot10{
            margin-bottom: 10px
        }
        .pageFiltro{
            margin: 0;
        }
        .pt5{
            padding-top: 5px;
        }
    </style>

@endsection

@section('content')
    <div class="product-model">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('buscarInmuebles')}}">Inmuebles</a></li>
                <li class="active">Filtrar</li>
            </ol>

            <div class="col-xs-12 col-md-9 product-model-sec" id="seccionResultados">
                @if ($mensaje == "coincidencias exactas")
                    <div class="alert alert-success" role="alert">
                        <strong>Excelente!</strong> Tu búsqueda ha generado los siguientes '+cantidad+' resultados:
                    </div>
                @else
                    <div class="alert alert-warning" role="alert"><strong>Lo sentimos!</strong> No hemos encontrado coincidencias exactas para tu busqueda.<br><strong>Espera:</strong>
                        @if($mensaje == "solo dpto y categoria")
                             Hemos encontrado articulos del tipo que buscas, en el mismo departamento:
                        @elseif($mensaje == 'solo tipo, estrato, accion y departamento')
                             Hemos encontrado articulos de este tipo, estrato y opcion de compra, en el departamento que buscas:
                        @elseif($mensaje == "exacto sin dpto")
                             Hemos encontrado articulos del tipo que buscas, en todo Colombia:
                        @elseif($mensaje == "solo categoria")
                             Hemos encontrado algunos articulos del tipo que buscas:
                        @else
                             Tambien puedes revisar nuestra lista de sugerencias:
                        @endif
                    </div>
                @endif
                <div id="listado">
                    @foreach($publicaciones as $publicacion)
                        <div class="row tiraPublicacion bordered puntero" data-id="{{$publicacion->id}}">
                            <div class="col-xs-4 conteFoto">
                                <div class="foto">
                                    <img class="img-rounded img-responsive" src='images/publicaciones/{{$publicacion->ruta}}' alt='' style="height: 100%; width: 100%">
                                </div>
                            </div>
                            <div class="col-xs-8">
                                @if($publicacion->destacado != "")
                                    <div class="col-xs-9 col-xs-offset-2 text-center">
                                        <div class="destacado bordered">
                                            Destacado
                                        </div>
                                    </div>
                                @endif
                                <div class="col-xs-12">
                                    <b><h3>{{ucwords($publicacion->titulo)}}</h3></b>
                                    <p class="marginBot10">
                                        <i class="fa fa-map-marker"></i>
                                        <span class="conver ubic"> {{$publicacion->municipio.", ".$publicacion->departamento}}</span>
                                    </p>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg">
                                    <br>&nbsp;
                                </div>
                                <div class="col-xs-12 precio marginBot10">
                                    <b><h3>$<span class="enmascarar">{{$publicacion->precio}}</span></h3></b>
                                </div>
                                <div class="hidden-xs marginBot10">
                                    <div class="inmuebles">
                                        <div class="col-xs-5">
                                            <b>Plantas: </b>{{$publicacion->cant_plantas}}
                                        </div>
                                        <div class="col-xs-7">
                                            <b>Habitaciones: </b>{{$publicacion->cant_habitaciones}}
                                        </div>
                                        <div class="col-xs-5">
                                            <b>Baños: </b>{{$publicacion->cant_banos}}
                                        </div>
                                        <div class="col-xs-7">
                                            <b>Garajes: </b>{{$publicacion->cant_garajes}}
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <b>Estrato: </b>{{$publicacion->estrato}}
                                    </div>
                                    <div class="col-xs-7">
                                        <b>Area: </b><span class="enmascarar">{{$publicacion->area}}</span> m<sup>2</sup>
                                    </div>
                                    @if($mensaje != "coincidencias exactas")
                                        <div class="col-xs-10">
                                            <b>Tipo: </b>{{$publicacion->tipo}}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xs-12 text-right" style="margin-top: 10px; padding: 0">
                                    {{$publicacion->fecha}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="paginacion" class="text-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#" onclick="return false" aria-label="Previous" class="anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for($i=1; $i<=ceil($cantidad/10); $i++)
                                <li class="{{($i == 1)?'active':''}}">
                                    <a href="#" data-page="{{$i}}" onclick="return false" class="pagina"><span>{{$i}} <span class="sr-only">(current)</span></span></a>
                                </li>
                            @endfor
                            <li class="{{(ceil($cantidad/10) == 1)?'disabled':''}}">
                                <a href="#" onclick="return false" aria-label="Next" class="sgte">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="rsidebar span_1_of_left">
                {!!Form::open(['id'=>'formVehiculo','autocomplete'=>'off'])!!}
                <section class="sky-form">
                    <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Ubicación</h4>
                    <div class="filtro">
                        {!!Form::select('departamento', $arrayDepartamento, $departamento, ['class'=>"form-control cambio", 'id' => 'departamento'])!!}
                        {!!Form::select('municipio_id', [], null, ['class'=>"form-control cambio",'placeholder' => 'Cualquier Municipio', 'id'=>'municipio_id'])!!}
                    </div>

                </section>

                <section class="sky-form">
                    <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Artículo</h4>
                    <div class="filtro">
                        {!!Form::select('categorias',$arrayCategorias, $categoria, ['id'=>'categorias','class'=>"form-control cambio",'placeholder' => 'Selecciona una categoria', 'required'])!!}
                        {!!Form::select('accion',['V'=>'En Venta','A'=>'En Arriendo','P'=>'En Permuta'], $accion, ['id'=>'accion','class'=>"form-control"])!!}
                    </div>
                </section>

                <div class="inmuebles">
                    <section class="sky-form">
                        <h4>Plantas</h4>
                        <div class="text-center filtro pt5">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pageFiltro plantas confir">
                                    <li><a onclick="return false;" href="#">0</a></li>
                                    <li><a onclick="return false;" href="#">1</a></li>
                                    <li><a onclick="return false;" href="#">2</a></li>
                                    <li><a onclick="return false;" href="#">3</a></li>
                                    <li><a onclick="return false;" href="#">4+</a></li>
                                </ul>
                            </nav>
                        </div>
                    </section>

                    <section class="sky-form">
                        <h4>Habitaciones</h4>
                        <div class="text-center filtro pt5">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pageFiltro habitaciones confir">
                                    <li><a onclick="return false;" href="#">0</a></li>
                                    <li><a onclick="return false;" href="#">1</a></li>
                                    <li><a onclick="return false;" href="#">2</a></li>
                                    <li><a onclick="return false;" href="#">3</a></li>
                                    <li><a onclick="return false;" href="#">4+</a></li>
                                </ul>
                            </nav>
                        </div>
                    </section>

                    <section class="sky-form">
                        <h4>Baños</h4>
                        <div class="text-center filtro pt5">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pageFiltro banos confir">
                                    <li><a onclick="return false;" href="#">0</a></li>
                                    <li><a onclick="return false;" href="#">1</a></li>
                                    <li><a onclick="return false;" href="#">2</a></li>
                                    <li><a onclick="return false;" href="#">3</a></li>
                                    <li><a onclick="return false;" href="#">4+</a></li>
                                </ul>
                            </nav>
                        </div>
                    </section>
                </div>

                <section class="sky-form filtro">
                    <h4>Estrato</h4>
                    <div id="slider-estrato"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 izquierda">
                            {!!Form::text('estrato', null, ['id'=>'estrato','class'=>"form-control text-right  texto", 'style'=>'border: 0; font-weight: NORMAL', 'readonly'])!!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left puntero" data-toggle="tooltip" style="padding-top: 5px;" title="Filtrar este rango de estratos">
                            <i class="fa fa-check-circle-o fa-2x confir" aria-hidden="true"></i>
                        </div>
                    </div>

                </section>

                <section class="sky-form filtro pt0">
                    <h4>Area m<sup>2</sup></h4>
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 izquierda">
                            {!!Form::text('areaMin', null, ['id'=>'areaMin','class'=>"form-control text-center", 'onkeypress' => 'return justNumbers(event)', "onkeyup"=>"format(this)" ,"onblur"=>"validarMin('area', this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Minima',"data-placement"=>"left", 'placeholder'=>'Min'])!!}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center texto">-</div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 derecha">
                            {!!Form::text('areaMax', null, ['id'=>'areaMax','class'=>"form-control text-center", 'onkeypress' => 'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onblur"=>"validarMax('area', this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Maxima', 'placeholder'=>'Max'])!!}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-left derecha texto puntero" data-toggle="tooltip" title="Filtrar este rango de areas">
                            <i class="fa fa-check-circle-o fa-2x confir" aria-hidden="true"></i>
                        </div>
                    </div>
                </section>

                <section class="sky-form filtro pt0">
                    <h4>Precio</h4>
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 izquierda">
                            {!!Form::text('precioMin', null, ['id'=>'precioMin','class'=>"form-control text-center", 'onkeypress' => 'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onblur"=>"validarMin('precio', this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Minimo', 'placeholder'=>'Min'])!!}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center texto">-</div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 derecha">
                            {!!Form::text('precioMax', null, ['id'=>'precioMax','class'=>"form-control text-center", 'onkeypress' => 'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onblur"=>"validarMax('precio', this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Maximo', 'placeholder'=>'Max'])!!}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-left derecha texto puntero" data-toggle="tooltip" title="Filtrar este rango de precios">
                            <i class="fa fa-check-circle-o fa-2x confir" aria-hidden="true"></i>
                        </div>
                    </div>
                </section>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script('plugins\jQueryUI\jquery-ui.min.js')!!}
    {!!Html::script('js\publicaciones.js')!!}
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}

    <script>
        var formulario;
        var pagina;
        var tipoInmueble;

        var plantas="";
        var habitaciones = "";
        var banos = "";

        $(function(){
            llenarMunicipios();
            enmascararPublicacion();
            convertirMayu();
            $('[data-toggle="tooltip"]').tooltip();
            pagina = 1;

            var estrato = '{{$estrato}}';
            if(estrato == "")
                estrato = 1;


            $("#slider-estrato").slider({
                range: true,
                min: 1,
                max: 6,
                values: [estrato , 6],
                slide: function( event, ui ) {  $( "#estrato" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#estrato" ).val($( "#slider-estrato" ).slider( "values", 0 ) + " - " + $( "#slider-estrato" ).slider( "values", 1 ));


            if ('{{$municipio}}' != "")
                $('#municipio_id').val('{{$municipio}}');

            formulario = $("#formVehiculo");

            $(".plantas li").click(function(){

                if (!$(this).hasClass('active')){
                    $(".plantas li").removeClass("active");
                    $(this).addClass("active");
                    plantas = $(this).children('a').text().replace('+', '');
                }
            });

            $(".habitaciones li").click(function(){
                if (!$(this).hasClass('active')){
                    $(".habitaciones li").removeClass("active");
                    $(this).addClass("active");
                    habitaciones = $(this).children('a').text().replace('+', '');
                }
            });

            $(".banos li").click(function(){
                if (!$(this).hasClass('active')){
                    $(".banos li").removeClass("active");
                    $(this).addClass("active");
                    banos = $(this).children('a').text().replace('+', '');
                }
            });
            tipoInmueble = '{{$inmueble}}';
            if(tipoInmueble == "Terreno")
                $(".inmuebles").addClass("hidden");
        });

        $(".confir").on('click', function(){
            pagina = 1;
            filtrar();
        });

        $(".cambio").on('change', function () {
            pagina = 1;
            filtrar();
        });

        $("#seccionResultados").on('click', '.tiraPublicacion', function () {
            window.location="publicacion/"+$(this).data("id");
        });

        $("#seccionResultados").on('click', '.pagina', function () {
            if (!$(this).parent().hasClass("active")) {
                pagina = parseInt($(this).attr("data-page"));
                console.log(pagina);
                filtrar();
            }
        });

        $("#seccionResultados").on('click', '.anterior', function () {
            if (!$(this).parent().hasClass("disabled")) {
                pagina = parseInt(pagina)-1;
                console.log(pagina);
                filtrar();
            }
        });

        $("#seccionResultados").on('click', '.sgte', function () {
            if (!$(this).parent().hasClass("disabled")) {
                pagina = parseInt(pagina)+1;
                console.log(pagina);
                filtrar();
            }
        });

        $("#departamento").change(function () {
            llenarMunicipios();
        });

        function validarMin(tipo, e){
                if ($("#"+tipo+"Max").val() != "" && (parseInt(desenmascarar($("#"+tipo+"Max").val())) < parseInt(desenmascarar(e.value))))
                    e.value = "0";
                }

        function validarMax(tipo, e){
            if ($("#"+tipo+"Min").val() != "" && (parseInt(desenmascarar($("#"+tipo+"Min").val())) > parseInt(desenmascarar(e.value))) ){
                    e.value = $("#"+tipo+"Min").val();
            }
        }

        function filtrar(){
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route(($inmueble=="Inmueble")?'getInmuebles':'getTerrenos')}}',
                data: formulario.serialize()+"&pagina="+pagina+"&plantas="+plantas+"&banos="+banos+"&habitaciones="+habitaciones,
                success: function(data) {
                    $("#seccionResultados").html(data);
                    enmascararPublicacion();
                    convertirMayu();
                    if(tipoInmueble == "Terreno")
                        $(".inmuebles").addClass("hidden");
                },
                error: function (data) {
                }
            });
        }

        function convertirMayu(){
            $(".conver").each(function(){
                $(this).html(ucWords($(this).html()));
            });
        }

        function llenarMunicipios(){
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('municipios')}}',
                data: { 'id' : $("#departamento").val()},
                async: false,
                success: function (data) {
                    $("#municipio_id").empty();
                    $("#municipio_id").append("<option value=''>Cualquier municipio</option>");
                    $.each(data,function (index,valor) {
                        $("#municipio_id").append('<option value='+index+'>'+valor+'</option>');
                    });
                },
                error: function (data) {
                }
            });
        }

        function enmascararPublicacion(){
            $(".enmascarar").each(function(){
                $(this).html(enmascarar($(this).html()));
            });
        }
    </script>

@endsection