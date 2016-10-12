@extends('layouts.principal')

@section('style')

@endsection

@section('content')
<!---->
<div class="contact">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Contact</li>
		</ol>
		<!---start-contact---->
		<h3>Contact Us</h3>
		<div class="section group">
			<div class="col-md-6 span_1_of_3">
				<div class="contact_info">
					<h4>Find Us Here</h4>
					<div class="map">
						<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:0.85em">View Larger Map</a></small>
					</div>
				</div>
				<div class="company_address">
					<h4>Company Information :</h4>
					<p>500 Lorem Ipsum Dolor Sit,</p>
					<p>22-56-2-9 Sit Amet, Lorem,</p>
					<p>USA</p>
					<p>Phone:(00) 222 666 444</p>
					<p>Fax: (000) 000 00 00 0</p>
					<p>Email: <a href="mailto:info@example.com">info@mycompany.com</a></p>
					<p>Follow on: <a href="#">Facebook</a>, <a href="#">Twitter</a></p>
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
							<span><textarea name="mansaje" required> </textarea></span>
						</div>
						<div>
							<span><input type="submit" class="mybutton" value="Enviar"></span>
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
				//console.log(formContacto.serialize());
				$.ajax({
					type:"POST",
					context: document.body,
					url: '{{route('enviar')}}',
					data:formContacto.serialize(),
					success: function(data){
						if (data=="exito") {

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