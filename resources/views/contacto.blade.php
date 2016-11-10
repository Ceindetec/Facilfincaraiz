@extends('layouts.principal')

@section('style')
	<style>
		.cargando{
			font-size: 16px;
		}
	</style>
@endsection

@section('content')
<!---->
<div class="contact">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="{{route("home")}}">Inicio</a></li>
			<li class="active">Contáctenos</li>
		</ol>
		<!---start-contact---->
		<h3>Contáctenos</h3>
		<div class="section group">
			<div class="col-md-6 span_1_of_3">
				{{--<div class="contact_info">
					<h4>Find Us Here</h4>
					<div class="map">
						<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:0.85em">View Larger Map</a></small>
					</div>
				</div>--}}
				<div class="company_address">
					<h4>Información de la empresa :</h4>
					{{--<p>500 Lorem Ipsum Dolor Sit,</p>
					<p>22-56-2-9 Sit Amet, Lorem,</p>--}}
					<p>Colombia</p>
					<p>Telefono: 3107536126 - 3214430862</p>
					<p>Email: <a href="mailto:ventas@facilfincaraiz.com">ventas@facilfincaraiz.com</a></p>
					<p>Siguenos en: <a href="https://www.facebook.com/www.facilfincaraiz/" target="_blank">Facebook</a>, <a href="#">Twitter</a></p>
					{{--<p>Fax: (000) 000 00 00 0</p>--}}
					<h4>Horario de atención</h4>
					<p>Lunes - viernes: 8:00 am a 6:00 pm</p>
					<p>Sabados: 8:00 am a 2:00 pm</p>

				</div>
			</div>
			<div class="col-md-6 span_2_of_3">
				<div class="contact-form">
					{!!Form::open(['id'=>'formContacto'])!!}
						<div>
							<span><label>Nombre</label></span>
							<span><input name="nombre" type="text" class="textbox" required></span>
						</div>
						<div>
							<span><label>E-MAIL</label></span>
							<span><input name="email" type="email" class="textbox" required></span>
						</div>
						<div>
							<span><label>Telefono</label></span>
							<span><input name="telefono" type="text" class="textbox" required></span>
						</div>
						<div>
							<span><label>Mensaje</label></span>
							<span><textarea name="mensaje" required> </textarea></span>
						</div>
					<div id="alertContacto" class="form-group ">


					</div>
						<div>
							{{--<span><input type="submit" class="mybutton" value="Enviar"></span>--}}

							<button class="btn btn-primary mybutton" type="submit" id="submitForm">Enviar <i class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
								<span class="sr-only">Loading...</span> </button>


						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
<!---->
@endsection

@section('scripts')

	<script>

		$(function(){
			var formContacto = $("#formContacto");
			formContacto.submit(function(e){
				e.preventDefault();
				$(".cargando").removeClass("hidden");
				//console.log(formContacto.serialize());
				$.ajax({
					type:"POST",
					context: document.body,
					url: '{{route('enviar')}}',
					data:formContacto.serialize(),
					success: function(data){
						if (data=="exito") {
							$(".cargando").addClass("hidden");
							$("#alertContacto").empty();

							html = '<div class="alert alert-success">'+
									'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
									'<strong>Perfecto!</strong> el mensaje fue enviado'+
									'</div>';


							$("#alertContacto").append(html);

						}
						else {
							//alert("Se genero un error Interno");
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