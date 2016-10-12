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
				 {!! Form::submit('Iniciar Sesión!',[]) !!}

			 <a class="acount-btn" href="{{route("registroUser")}}">Create an Account</a>
			 {!!Form::close()!!}
				 <a href="#">Forgot Password ?</a>
					
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