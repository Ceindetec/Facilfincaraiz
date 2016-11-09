<!DOCTYPE html>
<html>
<head>
    <title>FacilFincaRaiz</title>

{!!Html::style('plugins/bootstrap/css/bootstrap.css')!!}

<!-- Custom Theme files -->
    <!--theme-style-->
{!!Html::style('css/style.css')!!}
<!--//theme-style-->
    <!-- start menu -->
    {!!Html::style('css/memenu.css')!!}
    {!!Html::style('css/menuotro.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    @yield('style')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <meta name='csrf-param' content='authenticity_token'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>


    </style>


</head>
<body>
<!--header-->
<div class="top_bg">
    <div class="container">
        <div class="header_top-sec">
            <div class="top_right">
                <ul>
                    <li><a href="{{route("contacto")}}">Ayuda</a></li>
                    |
                    <li><a href="{{route("contacto")}}">Contáctenos</a></li>
                    |
                    <li><a href="login.html">Acerca de FácilFincaRaiz</a></li>
                </ul>
            </div>
            <div class="top_left">
                <ul>
                    @if(!Auth::guest())
                        <li class="top_link">Email:<a href="#" onclick="return false;">{{Auth::user()->email}}</a></li>|
                        <li class="top_link"><a href="{{route("logout")}}">Cerrar Sesión</a></li>
                    @else
                        <li class="top_link"><a href="{{route("login")}}">Iniciar Sesión</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<header>
    <div class="container">
        <div class="menu_bar" id="menu_bar">
            <a href="#" class="bt-menu"><span class="fa fa-bars control"></span>FácilFincaRaíz.com</a>
        </div>
        <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 logoFinal">
            <a href="{{route("home")}}"><img src="{{ URL::to('images/logo.png') }}" class="img-responsive"></a>
        </div>
        <nav id="menu_principal">
            <ul>
                <li><a href="{{route("home")}}"><span class="fa fa-home"></span>Inicio</a></li>
                {{--<li><a href="#">Servicios</a></li>--}}
                @if(!Auth::guest())
                    @if(Auth::user()->rol=="superAdmin")
                        <li><a href="{{route("registroAdmins")}}">Registrar</a></li>

                    @elseif(Auth::user()->rol=="admin"||Auth::user()->rol=="superAdmin")
                        <li class="submenu"><a href="#" onclick="return false;">Publicaciones <span
                                        class="prueba fa fa-sort-desc"></span></a>
                            <ul class="children">
                                <li><a href="{{route("publicPendientes")}}" class="center-block">Pendientes</a></li>
                                <li><a href="{{route("publicAprobadas")}}" class="center-block">Aprobadas</a></li>
                                <li><a href="{{route("publicInactivas")}}" class="center-block">Inactivas</a></li>
                            </ul>
                        </li>
                        <li class="submenu"><a href="#" onclick="return false;">Administrar <span
                                        class="prueba fa fa-sort-desc"></span></a>
                            <ul class="children">
                                <li class="center-block"><a href="{{route("adminBanner")}}">Banner</a></li>
                                <li class="center-block"><a href="{{route("marcaDeAgua")}}">Marca de agua</a></li>

                            </ul>
                        </li>
                    @elseif(Auth::user()->rol=="usuario")
                        <li class="submenu"><a href="{{route("publicar")}}"><span class="fa fa-gavel"></span>Publicar
                                <span class="prueba fa fa-sort-desc"></span></a>

                            <ul class="children">
                                <li><a href="{{route("publicarXCategoria","Inmuebles")}}"
                                       class="center-block">Inmueble</a></li>
                                <li><a href="{{route("publicarXCategoria","Terrenos")}}"
                                       class="center-block">Terreno</a></li>
                                <li><a href="{{route("publicarXCategoria","Vehiculos")}}"
                                       class="center-block">Vehículo</a></li>
                            </ul>

                        </li>
                    @endif
                @endif
                @if(!isset(Auth::user()->rol))
                    <li class="submenu"><a href="{{route("publicar")}}"><span class="fa fa-gavel"></span>Publicar
                            <span class="prueba fa fa-sort-desc"></span></a>

                        <ul class="children">
                            <li><a href="{{route("publicarXCategoria","Inmuebles")}}"
                                   class="center-block">Inmueble</a></li>
                            <li><a href="{{route("publicarXCategoria","Terrenos")}}"
                                   class="center-block">Terreno</a></li>
                            <li><a href="{{route("publicarXCategoria","Vehiculos")}}"
                                   class="center-block">Vehículo</a></li>
                        </ul>

                    </li>
                @endif
                <li><a href="{{route("contacto")}}"><span class="fa fa-envelope"></span>Contáctenos</a></li>
                @if(!Auth::guest())
                    <li class="Temporalesmenu"><a href="{{route("logout")}}"><span class="fa fa-user"></span>Cerrar
                            Sesión</a></li>
                @else
                    <li class="Temporalesmenu"><a href="{{route("login")}}"><span class="fa fa-user"></span>Iniciar
                            Sesión</a></li>
                @endif

            </ul>
        </nav>
    </div>
</header>

{{--<div class="header-top">
    <div class="header-bottom">
    <div class="">
        <div class="container">

            <div class="clearfix"></div>
            <!---->
        </div>
        <div class="clearfix"></div>
    </div>
</div>--}}


@yield('content')

<footer class="footer">
    <div class="container">
        <div class="ftr-grids">

            <div class="col-md-3 ftr-grid">
                <h4>Mas información</h4>
                <ul>
                    <li><a href="#">Acerca de FácilFincaRaiz</a></li>
                    <li><a href="contact.html">Terminos y condiciones</a></li>
                    <li><a href="{{route("contacto")}}">Contáctenos</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h4>servicio</h4>
                <ul>
                    <li><a href="{{route("publicar")}}">Pública con nosotros</a></li>
                    <li><a href="{{route("registroUser")}}">Registrate</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h4>Categorias</h4>
                <ul>
                    <li><a href="#">> Inmuebles</a></li>
                    <li><a href="#">> Terrenos</a></li>
                    <li><a href="{{route("buscarVehiculos")}}">> Vehículos</a></li>
                </ul>
            </div>
            {{--<div class="col-md-3 ftr-grid">
                <h4>Categorias</h4>
                <ul>
                    <li><a href="#">> Inmuebles</a></li>
                    <li><a href="#">> Terrenos</a></li>
                    <li><a href="{{route("buscarVehiculos")}}">> Vehículos</a></li>
                </ul>
            </div>--}}
            <div class="clearfix"></div>
        </div>
    </div>

</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{--{!!Html::script('js/jquery.js')!!}--}}
{!!Html::script('plugins\jQuery\jquery-2.2.3.min.js')!!}
<!-- /start menu -->
{!!Html::script('js/memenu.js')!!}
<!-- start menu -->
{!!Html::script('js/simpleCart.min.js')!!}
{!!Html::script('plugins/bootstrap/js/bootstrap.min.js')!!}
{!!Html::script('js/inicio.js')!!}
@yield('scripts')
<script type="application/x-javascript">
    addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
        window.scrollTo(0, 1);
    }

    $(document).ready(function () {
        $(".memenu").memenu();
    });

    $(function () {
        var CURRENT_URL = window.location.href;
        console.log(CURRENT_URL);
        var contador = 1;
        if(CURRENT_URL.split("/")[3]=="")
            CURRENT_URL = CURRENT_URL.substring(0,CURRENT_URL.length-1);

        $("#menu_principal").find('a[href="' + CURRENT_URL + '"]').addClass("active").parents("li").children("a").addClass("active");

        function main() {
            $('.menu_bar').click(function (event) {
                event.preventDefault();
                if (contador == 1) {
                    $('nav').animate({
                        left: '0'
                    });
                    $(this).find(".control").removeClass("fa-bars").addClass("fa-times");
                    contador = 0;
                } else {
                    contador = 1;
                    $('nav').animate({
                        left: '-100%'
                    });
                    $(this).find(".control").removeClass("fa-times").addClass("fa-bars");
                }
            });

            // Mostramos y ocultamos submenus
            $('.submenu').click(function () {
                $(this).children('.children').slideToggle();
            });

            ajustesmenu($(window).width());
        }

        $(window).resize(function () {
            ajustesmenu($(this).width());
        })

        main();
        $(".submenu").click(function (e) {
            if ($(window).width() <= 728) {
                e.preventDefault();
            }
        })
    })


    function ajustesmenu(ancho) {
        if (ancho <= 728) {
            $("#menu_bar").parent().removeClass("container");
        } else {
            $("#menu_bar").parent().addClass("container");
        }
    }

</script>
</body>
</html>
