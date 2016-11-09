@extends('layouts.principal')

@section('style')
    <style>
        .jssorb05 {
            position: absolute;
        }

        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('images/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }

        .jssorb05 div {
            background-position: -7px -7px;
        }

        .jssorb05 div:hover, .jssorb05 .av:hover {
            background-position: -37px -7px;
        }

        .jssorb05 .av {
            background-position: -67px -7px;
        }

        .jssorb05 .dn, .jssorb05 .dn:hover {
            background-position: -97px -7px;
        }

        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('images/a22.png') center center no-repeat;
            overflow: hidden;
        }

        .jssora22l {
            background-position: -10px -31px;
        }

        .jssora22r {
            background-position: -70px -31px;
        }

        .jssora22l:hover {
            background-position: -130px -31px;
        }

        .jssora22r:hover {
            background-position: -190px -31px;
        }

        .jssora22l.jssora22ldn {
            background-position: -250px -31px;
        }

        .jssora22r.jssora22rdn {
            background-position: -310px -31px;
        }

        .jssora22l.jssora22lds {
            background-position: -10px -31px;
            opacity: .3;
            pointer-events: none;
        }

        .jssora22r.jssora22rds {
            background-position: -70px -31px;
            opacity: .3;
            pointer-events: none;
        }
    </style>

    <style>
        .destacado {
            text-align: center;
            margin-top: 2em;
        }

        .destacado a {
            text-decoration: none;
        }

        .destacado .interno {
            /*border: 1px solid #ccc;*/
        }

        .destacado .baner_destacado {
            font-family: 'JosefinSans-Bold';
            position: absolute;
            top: 0;
            right: 0;
            color: #fff;
            display: block;
            padding: 3px 0 3px 0;
            background: #e8573e;
            font-size: 18px;
            padding: 5px;
            border-radius: 0px 0px 0px 5px;
            box-shadow: 0px 5px 10px;
        }

        .destacado .estrella {
            color: #f7ac15;
        }
    </style>

@endsection

@section('content')


    <!---->
    {{--<div class="banner">--}}
    <div id="jssor_1"
         style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" class="banner"
             style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
            @for($i=0;$i<count($imageSlider);$i++)
                <div data-p="225.00">
                    <img data-u="image" src="images/admin/{{$imageSlider[$i]->ruta}}"/>
                </div>
            @endfor
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;"
              data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;"
              data-autocenter="2"></span>
    </div>
    {{--</div>--}}
    <!---->
    <div class="welcome">
        <div class="container">
            <div class="col-md-12 welcome-left ">
                <h2 class="h2Josefin">¿Qué estás buscando?</h2>
            </div>
        </div>
    </div>
    <!---->
    <div class="bride-grids">
        <div class="container">
            <div class="col-md-4 bride-grid">
                <div class="content-grid l-grids">
                    <a href="">
                        <figure class="effect-bubba">
                            <img src="images/b1.jpg" alt=""/>
                            <figcaption>
                                <h4>Inmuebles </h4>
                                <p>Los mejores y cofiables inmuebles</p>
                            </figcaption>
                        </figure>
                    </a>
                    <div class="clearfix"></div>
                    <h3 class="text-center">Inmuebles</h3>
                </div>
            </div>
            <div class="col-md-4 bride-grid">
                <div class="content-grid l-grids">
                    <a href="">
                        <figure class="effect-bubba">
                            <img src="images/b2.jpg" alt=""/>
                            <figcaption>
                                <h4>Terrenos </h4>
                                <p>Los mejores y cofiables terrenos</p>
                            </figcaption>
                        </figure>
                    </a>
                    <div class="clearfix"></div>
                    <h3 class="text-center">Terrenos</h3>
                </div>
            </div>
            <div class="col-md-4 bride-grid">
                <div class="content-grid l-grids">
                    <a href="{{route("buscarVehiculos")}}">
                        <figure class="effect-bubba">
                            <img src="images/b3.jpg" alt=""/>
                            <figcaption>
                                <h4>Vehículos </h4>
                                <p>Los mejores y cofiables vehículos</p>
                            </figcaption>
                        </figure>
                    </a>
                    <div class="clearfix"></div>
                    <h3 class="text-center">Vehículos </h3>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!---->
    <div class="featured">
        <div class="container">
            <h3>Productos Destacados</h3>
            @if(count($destacados)<=4)
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">

                    @foreach($destacados as $desta)
                        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 destacado">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 interno">
                                <a href="product.html"><img src="images/publicaciones/{{$desta->galeria[0]->ruta}}"
                                                            alt=""
                                                            height="180px" width="100%"/>
                                    <div class="arrival-info">
                                        <h4>{{$desta->titulo}}</h4>
                                        <p class="preciovalor">{{$desta->precio}}</p>
                                        {{--<span class="pric1"><del>Rs 18000</del></span>--}}
                                        {{--<span class="disc">[12% Off]</span>--}}
                                    </div>
                                </a>
                                <div class="baner_destacado">
                                    <i class="fa fa-star estrella" aria-hidden="true"></i> Destacado
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
        </div>
        @else
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                @for($i=0;$i<4;$i++)
                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 destacado">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 interno">
                            <a href="product.html"><img src="images/publicaciones/{{$destacados[$i]->galeria[0]->ruta}}"
                                                        alt=""
                                                        height="180px" width="100%"/>
                                <div class="arrival-info">
                                    <h4>{{$destacados[$i]->titulo}}</h4>
                                    <p class="preciovalor">{{$destacados[$i]->precio}}</p>
                                    {{--<span class="pric1"><del>Rs 18000</del></span>--}}
                                    {{--<span class="disc">[12% Off]</span>--}}
                                </div>
                            </a>
                            <div class="baner_destacado">
                                <i class="fa fa-star estrella" aria-hidden="true"></i> Destacado
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                @for($i=4;$i<count($destacados);$i++)
                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 destacado">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 interno">
                            <a href="product.html"><img src="images/publicaciones/{{$destacados[$i]->galeria[0]->ruta}}"
                                                        alt=""
                                                        height="180px" width="100%"/>
                                <div class="arrival-info">
                                    <h4>{{$destacados[$i]->titulo}}</h4>
                                    <p class="preciovalor">{{$destacados[$i]->precio}}</p>
                                    {{--<span class="pric1"><del>Rs 18000</del></span>--}}
                                    {{--<span class="disc">[12% Off]</span>--}}
                                </div>
                            </a>
                            <div class="baner_destacado">
                                <i class="fa fa-star estrella" aria-hidden="true"></i> Destacado
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </div>
    <!---->
    <div class="arrivals">
        <div class="container">
            <h3>Últimas Publicaciones</h3>
            <div class="arrival-grids">
                <ul id="flexiselDemo1">
                    @for($i=0;$i<count($ultimasPublicaciones);$i++)
                        <li>
                            <a href="product.html"><img
                                        src="images/publicaciones/{!!$ultimasPublicaciones[$i]->galeria[0]->ruta !!}"
                                        alt="" height="180"/>
                                <div class="arrival-info">
                                    <h4>{!! $ultimasPublicaciones[$i]->titulo !!}</h4>
                                    <p class="preciovalor">{!! $ultimasPublicaciones[$i]->precio !!}</p>
                                    {{--<span class="pric1"><del>Rs 18000</del></span>--}}
                                    {{--<span class="disc">[12% Off]</span>--}}
                                </div>
                                <div class="viw">
                                    <a href="#"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Quick
                                        View</a>
                                </div>
                                <div class="shrt">
                                    <a href="#"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>Shortlist</a>
                                </div>
                            </a>
                        </li>
                    @endfor
                </ul>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    {{--{!!Html::script('js/jquery.js')!!}--}}
    {!!Html::script('js/jquery.flexisel.js')!!}
    {!!Html::script('js/jssor.slider-21.1.6.mini.js')!!}

    <script type="text/javascript">
        $(function () {
            var jssor_1_SlideoTransitions = [
                [{b: -1, d: 1, o: -1}, {b: 0, d: 1000, o: 1}],
                [{b: 1900, d: 2000, x: -379, e: {x: 7}}],
                [{b: 1900, d: 2000, x: -379, e: {x: 7}}],
                [{b: -1, d: 1, o: -1, r: 288, sX: 9, sY: 9}, {
                    b: 1000,
                    d: 900,
                    x: -1400,
                    y: -660,
                    o: 1,
                    r: -288,
                    sX: -9,
                    sY: -9,
                    e: {r: 6}
                }, {b: 1900, d: 1600, x: -200, o: -1, e: {x: 16}}]
            ];

            var jssor_1_options = {
                $AutoPlay: true,
                $SlideDuration: 800,
                $SlideEasing: $Jease$.$OutQuint,
                $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);


            $("#flexiselDemo1").flexisel({
                visibleItems: 4,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

            $(".preciovalor").each(function () {
                var texto = $(this).text();
                texto = enmascarar(texto);
                $(this).text(texto);
            })
        });

        function enmascarar(valor){
            valor = valor+'';
            var configurado = "";
            var i= valor.length;
            do{
                i=i-3;
                if (i>0)
                    configurado = "." + valor.substring(i, i+3)+configurado;
                else
                    configurado = valor.substring(i, i+3)+configurado;
            }while(i>0);
            return("$ "+configurado);
        }
    </script>

@endsection