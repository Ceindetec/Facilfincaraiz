                                                                                                                                                                                                                                                                                                                                                                                     @extends('layouts.principal')

@section('style')

    <style>
        .cargando{
            font-size: 16px;
        }
    </style>

@endsection

@section('content')
<!---->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route("home")}}">Inicio</a></li>
        <li class="active">Registra un admin</li>
    </ol>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h3>Administrador nuevo? <small>crea una cuenta</small></h3>
            {{--<h3>Administrador nuevo? <span> crea una cuenta </span></h3>--}}

            <div class="registration_form">
                <!-- Form -->
                {!!Form::open(['id' => 'formRegistro'])!!}
                    <div>
                        <label>
                            <input name="nombres" placeholder="Nombres:" type="text"  required autofocus>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="apellidos" placeholder="Apellidos:" type="text"  required autofocus>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="email" placeholder="Email:" type="email"  required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="telefono" placeholder="Telefono:" type="text"  required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="password" placeholder="contraseña" type="password" tabindex="4" required>
                        </label>
                    </div>
                    <div id="alertContacto" class="form-group ">


                    </div>
                    <div>
                        <button class="mybutton " type="submit" id="submitForm">Registrar un Admin <i class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
                            <span class="sr-only">Loading...</span> </button>
                    </div>

                {!!Form::close()!!}

            </div>
        </div>
    </div>
</div>
<!---->
@endsection

@section('scripts')

    <script>
        (function() {

            // Create input element for testing
            var inputs = document.createElement('input');

            // Create the supports object
            var supports = {};

            supports.autofocus   = 'autofocus' in inputs;
            supports.required    = 'required' in inputs;
            supports.placeholder = 'placeholder' in inputs;

            // Fallback for autofocus attribute
            if(!supports.autofocus) {

            }

            // Fallback for required attribute
            if(!supports.required) {

            }

            // Fallback for placeholder attribute
            if(!supports.placeholder) {

            }

        })();


        $(function(){

            var formRegistro = $("#formRegistro");
            formRegistro.submit(function(e){
                e.preventDefault();
                console.log(formRegistro.serialize());
                $(".cargando").removeClass("hidden");
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('registroAdminsPost')}}',
                    data:formRegistro.serialize(),
                    success: function(data){
                        $(".cargando").addClass("hidden");
                        $("#alertContacto").empty();
                        if (data=="exito") {
                            html = '<div class="alert alert-success">'+
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                                    '<strong>Perfecto!</strong> ya tienes un nuevo Administrador en FacilFicaRaiz'+
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                        else {
                            html = '<div class="alert alert-danger">'+
                                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                                    '<strong>Ups!</strong> No fue posible crear la cuenta ...'+
                                    '</div>';
                            $("#alertContacto").append(html);
                        }
                    },
                    error: function(){
                        console.log('ok');
                    }
                });
            });




        });



    </script>



@endsection