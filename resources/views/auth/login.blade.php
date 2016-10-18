@extends('layouts.principal')

@section('style')

@endsection

@section('content')
<!---->
<div class="login_sec">
	 <div class="container">
		<ol class="breadcrumb">
			 <li><a href="{{route("home")}}">Inicio</a></li>
			<li class="active">Login</li>
		</ol>
		<h2>Login</h2>
		<div class="col-md-6 log">
			<p>Welcome, please enter the folling to continue.</p>
			<p>If you have previously Login with us, <span>click here</span></p>
			{!!Form::open(['route' => 'login'])!!}
			<h5>Email:</h5>
			{!!Form::email('email',null,[], 'required')!!}
			<h5>Password:</h5>
			{!! Form::password('password',[], 'required')!!}
			 @if (count($errors) > 0)
				 <div class="alert alert-danger">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close" style="text-decoration: none; color: #000;">&times;</a>
					 <strong>Ups!</strong> Favor corregir los siguientes errores.<br><br>
					 <ul class="text-left">
						 @foreach ($errors->all() as $error)
							 <li>{{ $error }}</li>
						 @endforeach
					 </ul>
				 </div>
			 @endif
			{!! Form::submit('Iniciar Sesión!',[]) !!}

			 <a class="acount-btn" href="{{route("registroUser")}}">Crear una Cuenta</a>
			{!!Form::close()!!}
				 <a href="{{route("getEmail")}}">Olvide mi Contraseña</a>

		</div>

		<div class="clearfix"></div>
	</div>
</div>
<!---->
@endsection

@section('scripts')

	<script>

/*		$(function(){
			var formLogin = $("#login");
			formLogin.submit(function(e){
				e.preventDefault();
				console.log(formLogin.serialize());


			});

		});*/




	</script>



@endsection