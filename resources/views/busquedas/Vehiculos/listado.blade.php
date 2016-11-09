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
            height: 150px;
        }
        .foto{
            height: 100%;
        }
        .bordered{
            border: solid 2px #f5f5f5;
            /*border-radius: 5px;*/
        }
        @media (max-width: 600px) {
            .conteFoto{
                padding: 0;
                height: 130px;;
            }
            .tiraPublicacion{
                margin: 0 0 4px 0;
            }
            #seccionResultados{
                padding: 0;
            }
        }
        .tiraPublicacion { transition: all .2s ease-out; }
        .tiraPublicacion:hover { box-shadow: 1px 3px 10px #373737;transform: scale(1.05); }
        .destacado{
            background: #e8573e;
            color: white;
            margin-bottom: 7px;
        }
    </style>

@endsection

@section('content')
    <div class="product-model">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('buscarVehiculos')}}">Vehiculos</a></li>
                <li class="active">Filtrar</li>
            </ol>

            <div class="col-xs-12 col-md-9 product-model-sec" id="seccionResultados">
                <div id="listado">
                    @foreach($publicaciones as $publicacion)
                        <div class="row tiraPublicacion bordered puntero" data-id="{{$publicacion->id}}">
                            <div class="col-xs-3 conteFoto">
                                <div class="foto">
                                    <img class="img-rounded img-responsive" src='images/publicaciones/{{$publicacion->ruta}}' alt='' style="height: 100%; width: 100%">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                @if($publicacion->destacado != "")
                                    <div class="col-xs-6 col-xs-offset-6 destacado bordered text-center">
                                        Destacado
                                    </div>
                                @endif
                                <div class="col-xs-12">
                                    <b><h3>{{ucwords($publicacion->titulo)}}</h3></b><br>
                                    <p>
                                        {{$publicacion->modelo}} - <span class="enmascarar">{{$publicacion->kilometraje}}</span>&nbsp;km
                                        <br>
                                        @if($mensaje == "sugerencias")
                                            Tipo: {{$publicacion->tipo}}<br>
                                            Marca: {{$publicacion->marca}}
                                        @endif
                                    </p>
                                    <p class="conver">
                                        en {{$publicacion->municipio}},&nbsp;{{$publicacion->departamento}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="text-right">
                                    {{$publicacion->fecha}}
                                </div>
                                <div style="margin-top: 40px">
                                    <b><h4>$<span class="enmascarar">{{$publicacion->precio}}</span></h4></b>
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
                            <li class="{{($cantidad/10 == 1)?'disabled':''}}">
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
                        {!!Form::select('marca',[], null, ['id'=>'marca','class'=>"form-control cambio",'placeholder' => 'Cualquier marca'])!!}
                        {!!Form::select('cilindraje',['1'=>'0 a 99 cc','2'=>'100 a 199 cc','3'=>'200 a 299 cc','4'=>'300 a 399 cc','5'=>'400 a 699 cc','6'=>'700 a 999 cc','7'=>'1000 a 1299 cc','8'=>'más de 1300 cc'], null, ['id'=>'cilindraje','class'=>"form-control cambio", 'placeholder' => 'Cualquier cilindraje'])!!}
                    </div>
                </section>

                <section class="sky-form filtro">
                    <h4>Modelo</h4>
                    <div id="slider-modelo"></div>
                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-9 col-lg-9">
                            {!!Form::text('modelo', null, ['id'=>'modelo','class'=>"form-control text-right", 'style'=>'border: 0; font-weight: NORMAL', 'readonly'])!!}
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-3 col-lg-3 text-left derecha texto puntero" data-toggle="tooltip" title="Filtrar este rango de modelos">
                            <i class="fa fa-check-circle-o fa-2x confir" aria-hidden="true"></i>
                        </div>
                    </div>

                </section>

                <section class="sky-form filtro">
                    <h4>Precio</h4>
                    <div id="slider-precio"></div>
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 izquierda">
                            {!!Form::text('precioMin', null, ['id'=>'precioMin','class'=>"izquierda form-control text-right", 'style'=>'border: 0; font-weight: NORMAL', 'onkeypress' => 'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onchange"=>"format(this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Minimo',"data-placement"=>"left"])!!}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center texto">-</div>
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 derecha" style='padding-right: 0'>
                            {!!Form::text('precioMax', null, ['id'=>'precioMax','class'=>"derecha form-control text-left", 'style'=>'border: 0; font-weight: NORMAL', 'onkeypress' => 'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onchange"=>"format(this)", 'maxlength'=>'11', 'data-toggle'=>"tooltip", 'title'=>'Maximo'])!!}
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
        $(function(){
            llenarMunicipios();
            cambiarTipo($("#categorias option:selected").text());
            enmascararPublicacion();
            convertirMayu();
            $('[data-toggle="tooltip"]').tooltip();
            pagina = 1;
            $("#listado").prepend(generarAnuncio('{{$mensaje}}', '{{$cantidad}}'));
            var fecha = new Date();
            var modelo = '{{$modelo}}';
            if(modelo == "")
                modelo = fecha.getFullYear()-50;
            $("#slider-modelo").slider({
                range: true,
                min: fecha.getFullYear()-50,
                max: fecha.getFullYear()+1,
                values: [modelo , fecha.getFullYear()+1 ],
                slide: function( event, ui ) {  $( "#modelo" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#modelo" ).val($( "#slider-modelo" ).slider( "values", 0 ) + " - " + $( "#slider-modelo" ).slider( "values", 1 ));

            $("#slider-precio").slider({
                range: true,
                min: 100,
                max: 800000,
                step: 50,
                values: [0 , 800000],
                slide: function( event, ui ) {
                    $( "#precioMin" ).val("$"+enmascarar(ui.values[ 0 ]*1000));
                    $( "#precioMax" ).val("$"+enmascarar(ui.values[ 1 ]*1000));
                }
            });
            $( "#precioMin" ).val("$"+enmascarar($( "#slider-precio" ).slider( "values", 0 )*1000));
            $( "#precioMax" ).val("$"+enmascarar($( "#slider-precio" ).slider( "values", 1 )*1000));

            if ('{{$municipio}}' != "")
                $('#municipio_id').val('{{$municipio}}');

            if ('{{$marca}}' != "")
                $('#marca').val('{{$marca}}');

            formulario = $("#formVehiculo");
        });

        function generarAnuncio(mensaje, cantidad){
            var resultados = "";
            if (mensaje == "coincidencias exactas") {
                resultados ='<div class="alert alert-success" role="alert">' +
                        '<strong>Excelente!</strong> Tu búsqueda ha generado los siguientes '+cantidad+' resultados:' +
                        '</div>';
            }
            else {
                resultados = '<div class="alert alert-warning" role="alert"><strong>Lo sentimos!</strong> No hemos encontrado coincidencias exactas para tu busqueda.<br>';
                if(mensaje == "solo dpto y categoria")
                    resultados = resultados + "<strong>Espera:</strong> Hemos encontrado vehiculos del tipo que buscas, en el mismo departamento:";
                else if(mensaje == "exacto sin dpto")
                    resultados = resultados + "<strong>Espera:</strong >Hemos encontrado vehiculos del tipo que buscas, en todo Colombia:";
                else if(mensaje == "solo categoria")
                    resultados = resultados + "<strong>Espera:</strong> Hemos encontrado algunos vehiculos del tipo que buscas:";
                else
                    resultados = resultados + "<strong>Espera:</strong> Tambien puedes revisar nuestra lista de sugerencias:";
                resultados = resultados + "</div>";
            }
            return resultados;
        }

        $("#categorias").change(function () {
            cambiarTipo($("#categorias option:selected").text());
        });

        function cambiarTipo(seleccionado) {
            if (seleccionado == 'Moto' || seleccionado == 'Moto-Carro' || seleccionado == 'Cuatrimoto') {
                $("#cilindraje").removeClass('hidden');
                llenarMarca("M");
            }
            else {
                $("#cilindraje").addClass('hidden');
                llenarMarca('C');
            }
        }

        $(".confir").on('click', function(){
            pagina = 1;
            filtrar();
        });

        $(".cambio").on('change', function () {
            pagina = 1;
            filtrar();
        });

        $("#listado").on('click', '.tiraPublicacion', function () {
            window.location="articulo/"+$(this).data("id");
        });

        $("#paginacion").on('click', '.pagina', function () {
            if (!$(this).parent().hasClass("active")) {
                pagina = $(this).attr("data-page");
                filtrar();
            }
        });

        $("#paginacion").on('click', '.anterior', function () {
            if (!$(this).parent().hasClass("disabled")) {
                pagina = pagina-1;
                filtrar();
            }
        });

        $("#paginacion").on('click', '.sgte', function () {
            if (!$(this).parent().hasClass("disabled")) {
                pagina = pagina+1;
                filtrar();
            }
        });

        $("#precioMin").focus(function(){
            $(this).val(desenmascarar($(this).val()));
            format($("#precioMin")[0]);
        });

        $("#precioMin").blur(function(){
            var sliderElement = $("#slider-precio");
            var valor = desenmascarar($(this).val())/1000;
            if (valor >= sliderElement.slider("option")['min'] && valor <= sliderElement.slider("option")['max']){
                sliderElement.slider("values", 0, valor);
                $(this).val("$"+enmascarar(valor*1000));
            }
            else{
                $(this).val("$"+enmascarar(sliderElement.slider("values", 0)*1000));
            }
        });

        $("#precioMax").focus(function(){
            $(this).val(desenmascarar($(this).val()));
            format($("#precioMax")[0]);
        });

        $("#precioMax").blur(function(){
            var sliderElement = $("#slider-precio");
            var valor = desenmascarar($(this).val())/1000;
            console.log(valor);
            if (valor >= sliderElement.slider("option")['min'] && valor <= sliderElement.slider("option")['max'] && valor >= sliderElement.slider("values", 0)){
                sliderElement.slider("values", 1, valor);
                $(this).val("$"+enmascarar(valor*1000));
            }
            else{
                $(this).val("$"+enmascarar(sliderElement.slider("values", 1)*1000));
            }
        });

        $("#departamento").change(function () {
            llenarMunicipios();
        });

        function filtrar(){
            $.ajax({
                type:"POST",
                context: document.body,
                url: '{{route('getVehiculos')}}',
                data: formulario.serialize()+"&pagina="+pagina,
                success: function(data) {
                    var resultados = generarAnuncio(data.mensaje, data.cantidad);
                    data.publicaciones.forEach(function(entry){
                        resultados = resultados + '<div class="row tiraPublicacion bordered puntero" data-id="'+entry.id+'">' +
                                                        '<div class="col-xs-3 conteFoto">' +
                                                            '<div class="foto">' +
                                                                '<img class="img-rounded img-responsive" src="images/publicaciones/'+entry.ruta+'" style="height: 100%; width: 100%">' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<div class="col-xs-6">';
                        if(entry.destacado != "") {
                            resultados = resultados +'<div class="col-xs-6 col-xs-offset-6 destacado bordered text-center">Destacado</div>';
                        }
                        resultados = resultados + '<div class="col-xs-12">' +
                                                        '<b><h3 class="conver">'+entry.titulo+'</h3></b><br>'+
                                                        '<p>'+entry.modelo+' - <span class="enmascarar">'+entry.kilometraje+'</span>&nbsp;km<br>';
                        if(data.mensaje == "sugerencias") {
                            resultados = resultados + 'Tipo: '+entry.tipo+'<br>'+
                                                      'Marca: '+entry.marca;
                        }
                        resultados = resultados + '</p>' +
                                                  '<p class="conver">en '+entry.municipio+',&nbsp;'+entry.departamento+'</p>'+
                                                  '</div></div><div class="col-xs-3"><div class="text-right">'+entry.fecha+'</div><div style="margin-top: 40px"><b><h4>$<span class="enmascarar">'+entry.precio+'</span></h4></b></div></div></div>';
                    });
                    $("#listado").html(resultados);
                    var active = (data.pagina==1)?'disabled':'';
                    var paginacion = '<nav aria-label="Page navigation">' +
                                        '<ul class="pagination">' +
                                            '<li class="'+active+'">' +
                                                '<a href="#" onclick="return false" aria-label="Previous" class="anterior">' +
                                                    '<span aria-hidden="true">&laquo;</span>' +
                                                '</a>' +
                                            '</li>';
                    for(var i=1; i<=Math.ceil(data.cantidad/10); i++) {
                        active = (i==data.pagina)? 'active':'';
                        paginacion = paginacion + '<li class="' + active + '">' +
                                                        '<a href="#" data-page="'+i+'" onclick="return false" class="pagina">' +
                                                            '<span>'+i+'<span class="sr-only">(current)</span></span>' +
                                                        '</a>' +
                                                    '</li>';
                    }
                    active = (data.pagina == Math.ceil(data.cantidad/10))?'disabled':'';
                    paginacion = paginacion + '<li class="' +active+ '">' +
                                                    '<a href="#" onclick="return false" aria-label="Next" class="sgte">' +
                                                        '<span aria-hidden="true">&raquo;</span>' +
                                                    '</a>' +
                                                '</li>' +
                                            '</ul>' +
                                        '</nav>';
                    $("#paginacion").html(paginacion);
                    enmascararPublicacion();
                    convertirMayu();
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

        function llenarMarca(tipo) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('marcas')}}',
                data: {'tipo' : tipo},
                async: false,
                success: function (data) {
                    $("#marca").empty();
                    $("#marca").append("<option value=''>Cualquier marca</option>");
                    $.each(data,function (index,valor) {
                        $("#marca").append('<option value='+index+'>'+valor+'</option>');
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