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
                    <li><a href="#">help</a></li>
                    |
                    <li><a href="contact.html">Contact</a></li>
                    |
                    <li><a href="login.html">Track Order</a></li>
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
        <nav>
            <ul>
                <li><a href="{{route("home")}}"><span class="fa fa-home"></span>Inicio</a></li>
                <li><a href="#">Servicios</a></li>
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
                <li><a href="{{route("contacto")}}"><span class="fa fa-envelope"></span>Contacto</a></li>
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

<div class="header-top">
    {{--<div class="header-bottom">--}}
    <div class="">
        <div class="container">
        {{-- <div class="logo" style="width: 20%">
             <a href="{{route("home")}}"><img src="{{ URL::to('images/logo.png') }}"></a>
         </div>
         <!---->

         <div class="top-nav">
                <ul class="memenu skyblue"><li class="{{ (\Request::route()->getName() == 'home') ? 'active' : '' }}"><a href="{{route("home")}}">Home</a></li>
                   {{-- <li class="grid"><a href="#">Wedding</a>
                     <div class="mepanel">
                         <div class="row">
                             <div class="col1 me-one">
                                 <h4>Shop</h4>
                                 <ul>
                                     <li><a href="product.html">New Arrivals</a></li>
                                     <li><a href="product.html">Men</a></li>
                                     <li><a href="product.html">Women</a></li>
                                     <li><a href="product.html">Accessories</a></li>
                                     <li><a href="product.html">Kids</a></li>
                                     <li><a href="login.html">login</a></li>
                                     <li><a href="product.html">Brands</a></li>
                                     <li><a href="product.html">My Shopping Bag</a></li>
                                 </ul>
                             </div>
                             <div class="col1 me-one">
                                 <h4>Style Zone</h4>
                                 <ul>
                                     <li><a href="product.html">Men</a></li>
                                     <li><a href="product.html">Women</a></li>
                                     <li><a href="product.html">Brands</a></li>
                                     <li><a href="product.html">Kids</a></li>
                                     <li><a href="product.html">Accessories</a></li>
                                     <li><a href="product.html">Style Videos</a></li>
                                 </ul>
                             </div>
                             <div class="col1 me-one">
                                 <h4>Popular Brands</h4>
                                 <ul>
                                     <li><a href="product.html">Levis</a></li>
                                     <li><a href="product.html">Persol</a></li>
                                     <li><a href="product.html">Nike</a></li>
                                     <li><a href="product.html">Edwin</a></li>
                                     <li><a href="product.html">New Balance</a></li>
                                     <li><a href="product.html">Jack & Jones</a></li>
                                     <li><a href="product.html">Paul Smith</a></li>
                                     <li><a href="product.html">Ray-Ban</a></li>
                                     <li><a href="product.html">Wood Wood</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                    </li>

                 @if(!Auth::guest())
                         @if(Auth::user()->rol=="superAdmin")
                            <li class="{{ (\Request::route()->getName() == 'registroAdmins') ? 'active' : '' }}"><a href="{{route("registroAdmins")}}">Registrar</a>

                         </li>
                            @endif

                            @if(Auth::user()->rol=="admin"||Auth::user()->rol=="superAdmin")
                            <li id="liPublicaciones" class=""><a href="#" onclick="return false;">Publicaciones</a>
                             <div class="mepanel">
                                 <div class="row" style="margin: 0 auto;">
                                     <div class="col3 me-one">
                                         <h4 class="text-center">Publicar</h4>
                                         <ul>
                                             <li><a href="{{route("publicPendientes")}}" class="center-block">Pendientes</a></li>
                                             <li><a href="{{route("publicAprobadas")}}" class="center-block">Aprobadas</a></li>
                                             <li><a href="{{route("publicInactivas")}}" class="center-block">Inactivas</a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                            <li class=""><a href="#" onclick="return false;">Administrar</a>
                                <div class="mepanel menuMarca">
                                    <div class="row" style="margin: 0 auto;">
                                        <div class="col3 me-one">
                                            <h4 class="text-center">Publicar</h4>
                                            <ul>
                                                <li class="center-block"><a href="{{route("adminBanner")}}" >Banner</a></li>
                                                <li class="center-block"><a href="{{route("marcaDeAgua")}}" >Marca de agua</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                         @elseif(Auth::user()->rol=="usuario")
                            <li id="liPublicar" class="{{ (\Request::route()->getName() == 'publicar') ? 'active' : '' }}"><a href="{{route("publicar")}}">Publicar</a>
                             <div class="mepanel">
                                 <div class="row" style="margin: 0 auto;">
                                     <div class="col3 me-one">
                                         <h4 class="text-center">Publicar</h4>
                                         <ul>
                                             <li><a href="{{route("publicarXCategoria","Inmuebles")}}" class="center-block">Inmueble</a></li>
                                             <li><a href="{{route("publicarXCategoria","Terrenos")}}" class="center-block">Terreno</a></li>
                                             <li><a href="{{route("publicarXCategoria","Vehiculos")}}" class="center-block">Vehículo</a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     @endif
                 @endif
                    <li class="{{ (\Request::route()->getName() == 'contacto') ? 'active' : '' }}"><a href="{{route("contacto")}}">Contacto</a></li>
             </ul>
             <div class="clearfix"> </div>
         </div>--}}

        <!-- desde aca iria el nuevo menu-->


            <!-- aca termina el nuevo menu-->


            <div class="clearfix"></div>
            <!---->
        </div>
        <div class="clearfix"></div>
    </div>
</div>


@yield('content')

<footer class="footer">
    <div class="container">
        <div class="ftr-grids">
            <div class="col-md-3 ftr-grid">
                <h4>About Us</h4>
                <ul>
                    <li><a href="#">Who We Are</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#">Our Sites</a></li>
                    <li><a href="#">In The News</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h4>Customer service</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Cancellation</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Bulk Orders</a></li>
                    <li><a href="#">Buying Guides</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h4>Your account</h4>
                <ul>
                    <li><a href="account.html">Your Account</a></li>
                    <li><a href="#">Personal Information</a></li>
                    <li><a href="#">Addresses</a></li>
                    <li><a href="#">Discount</a></li>
                    <li><a href="#">Track your order</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">> Wedding</a></li>
                    <li><a href="#">> Jewellerys</a></li>
                    <li><a href="#">> Shoes</a></li>
                    <li><a href="#">> Flowers</a></li>
                    <li><a href="#">> Cakes</a></li>
                    <li><a href="#">...More</a></li>
                </ul>
            </div>
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
        var contador = 1;

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
