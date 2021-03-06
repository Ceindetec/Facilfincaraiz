                                                                                                                                                                                                                                                                                                                                                                                     @extends('layouts.principal')

@section('style')

    <style>
        .cargando {
            font-size: 16px;
        }
    </style>

@endsection

@section('content')
    <!---->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route("home")}}">Inicio</a></li>
            <li class="active">Registro</li>
        </ol>
        <div class="registration">
            <div class="registration_left">
                <h2>Usuario nuevo? <span> crea una cuenta </span></h2>

                <div class="registration_form">
                    <!-- Form -->
                    {!!Form::open(['id' => 'formRegistro'])!!}
                    <div>
                        <input name="nombres" placeholder="Nombres:" type="text"  required autofocus>
                    </div>
                    <div>
                        <input name="apellidos" placeholder="Apellidos:" type="text" required autofocus>
                    </div>
                    <div>
                        <input name="email" placeholder="Email:" type="email" required>
                    </div>
                    <div>
                        <input name="telefono" placeholder="Telefono:" type="text" required>
                    </div>
                    {{--                    <div class="sky_form1">
                                            <ul>
                                                <li><label class="radio left"><input type="radio" name="radio" checked=""><i></i>Male</label></li>
                                                <li><label class="radio"><input type="radio" name="radio"><i></i>Female</label></li>
                                                <div class="clearfix"></div>
                                            </ul>
                                        </div>--}}
                    <div>
                        <input name="password" placeholder="contraseña" type="password" t required>
                    </div>
                    <div>
                        <input name="cpassword" placeholder="confirmar cantraseña" type="password" required>
                    </div>
                    <div id="alertContacto" class="form-group ">


                    </div>
                    <div>
                        <button class="mybutton " type="submit" id="submitForm">Registrarme! <i
                                    class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
                            <span class="sr-only">Loading...</span></button>
                    </div>
                {{--                    <div class="sky-form">
                                        <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>i agree to mobilya.com &nbsp;<a class="terms" href="#"> terms of service</a> </label>
                                    </div>--}}
                {!!Form::close()!!}
                <!-- /Form -->
                </div>
            </div>
            <div class="registration_left">
                <h2>Ya tienes una cuenta</h2>
                <div class="registration_form">
                    <!-- Form -->
                    {!!Form::open(['route' => 'login'])!!}
                    <div>
                        <label>
                            <input name="email" placeholder="email:" type="email" tabindex="3" required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="password" placeholder="contraseña" type="password" tabindex="4" required>
                        </label>
                    </div>
                    <div>
                        <input type="submit" value="Iniciar Sesión" id="register-submit">
                    </div>
                    <div class="forget">
                        <a href="{{route("getEmail")}}">Olvide mi contraseña</a>
                    </div>
                {!!Form::close()!!}
                <!-- /Form -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!---->
@endsection

@section('scripts')

    <script>
        (function () {

            // Create input element for testing
            var inputs = document.createElement('input');

            // Create the supports object
            var supports = {};

            supports.autofocus = 'autofocus' in inputs;
            supports.required = 'required' in inputs;
            supports.placeholder = 'placeholder' in inputs;

            // Fallback for autofocus attribute
            if (!supports.autofocus) {

            }

            // Fallback for required attribute
            if (!supports.required) {

            }

            // Fallback for placeholder attribute
            if (!supports.placeholder) {

            }

            // Change text inside send button on submit
            var send = document.getElementById('register-submit');
            if (send) {
                send.onclick = function () {
                    this.innerHTML = '...Sending';
                }
            }

        })();


        $(function () {

            var formRegistro = $("#formRegistro");
            formRegistro.submit(function (e) {
                e.preventDefault();
                console.log(formRegistro.serialize());
                $(".cargando").removeClass("hidden");
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('registroUserPost')}}',
                    data: formRegistro.serialize(),
                    success: function (data) {
                        $(".cargando").addClass("hidden");
                        $("#alertContacto").empty();
                        if (data == "exito") {
                            html = '<div class="alert alert-success">' +
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Perfecto!</strong> ya tienes una cuanta en FacilFicaRaiz' +
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                        else {
                            html = '<div class="alert alert-danger">' +
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                    '<strong>Ups!</strong> No fue posible crear la cuenta ...' +
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                    },
                    error: function () {
                        console.log('ok');
                    }
                });
            });


        });


    </script>



@endsection