@extends('layouts.principal')

@section('style')

	<style>
		#map {
			width: 100%;
			height: 200px;
			margin-bottom: 20px;
		}

	</style>


@endsection

@section('content')
<!---->

<div class="row">
	<div class="col-xs-12" style="margin-bottom: 30px">
		<h2 class="text-center h2Josefin"> Publicar Un Inmueble </h2>
	</div>
</div>


<div class="bride-grids">
	<div class="container">


{{--			<form>

				<div class="row">
				<div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Titulo</label>
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Titulo">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>

					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>

					</div>
				</div>

				<div class="row">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>

			</form>--}}




		<form class="form-horizontal">

			<div class="row">
				<div class="col-sm-offset-2 col-sm-8">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputEmail3" placeholder="Titulo">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Categorias</label>
						<div class="col-sm-8">
							{!!Form::select('categorias',$arrayCategorias, null, ['class'=>"form-control",'placeholder' => 'Seleccione una categoria'])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Acción</label>
						<div class="col-sm-8">
							{!!Form::select('categorias',['V'=>'Vender','A'=>'Arrendar','P'=>'Permutar'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Precio</label>
						<div class="col-sm-8">
							{!!Form::text('precio',null,['class'=>'form-control','placeholder'=>"precio del inmueble", 'required'])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Estrato</label>
						<div class="col-sm-8">
							{!!Form::select('strato',['1'=>'Estrato 1','2'=>'Estrato 2','3'=>'Estrato 3','4'=>'Estrato 4','5'=>'Estrato 5','6'=>'Estrato 6'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Número de Habitaciones</label>
						<div class="col-sm-8">
							{!!Form::select('cant_habitaciones',['1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Número de Baños</label>
						<div class="col-sm-8">
							{!!Form::select('cant_banos',['1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Número de Plantas</label>
						<div class="col-sm-8">
							{!!Form::select('cant_plantas',['1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Número de Garajes</label>
						<div class="col-sm-8">
							{!!Form::select('cant_garajes',['1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['class'=>"form-control"])!!}
						</div>
					</div>
				</div>
			</div>


			<div class="row" style="margin: 15px 0">
				<h3 class="h3Josefin text-center">Dimenciones</h3>
			</div>


			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Frente (m)</label>
						<div class="col-sm-8">
							{!!Form::text('frente',null,['class'=>'form-control','placeholder'=>"metros de frente", 'required'])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Fondo (m)</label>
						<div class="col-sm-8">
							{!!Form::text('fondo',null,['class'=>'form-control','placeholder'=>"metros de fondo", 'required'])!!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Area total (m2)</label>
						<div class="col-sm-8">
							{!!Form::text('area',null,['class'=>'form-control','placeholder'=>"area total metros cuadrados", 'required'])!!}
						</div>
					</div>
				</div>

			</div>

			<div class="row" style="margin: 15px 0">
				<h3 class="h3Josefin text-center">Ubicación</h3>
			</div>


			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('departamento', 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento'])!!}
						</div>
					</div>
					<div class="form-group" id="divMinucipio">
						{!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
						<div class="col-sm-8">
							{!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio'])!!}
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Dirección</label>
						<div class="col-sm-8">
							{!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>"calle 24A No.15 - 30", 'required'])!!}
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Geolocalización</label>
						<div class="col-sm-8">
							{!!Form::text('coords',null,['class'=>'form-control','id'=>'coords','required','disabled'])!!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div id="map"></div>


				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" class="mybutton center-block">Publicar</button>
				</div>
			</div>
		</form>
		<form method="post" id="geocoding_form">
			<label for="address">Address:</label>
			<div class="input">
				<input type="text" id="address" name="address" />
				<input type="submit" class="btn" value="Search" />
			</div>
		</form>
	</div>
</div>
<!---->
@endsection

@section('scripts')
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&sensor=true"></script>
		{!!Html::script('js/gmaps.js')!!}
	<script>
		var map;
		$(function(){
			$("#tipoArticulo").change(function(){
				console.log($(this).val());
			});


			$("#departamento").change(function () {

				if($("#departamento").val()==""){
					//alert("el id es nulo");
					$("#municipio_id").empty();
					$("#municipio_id").append("<option value=''>Selecciona un Municipio</option>");
				}else{
					//alert("el id es "+$("#departamento").val());
					$.ajax({
						type: "POST",
						context: document.body,
						url: '{{route('municipios')}}',
						data: { 'id' : $("#departamento").val()},
						success: function (data) {

							$("#municipio_id").empty();

							$.each(data,function (index,valor) {
								$("#municipio_id").append('<option value='+index+'>'+valor+'</option>');

								//console.log("la key es "+index+" y el valor es "+valor);
							});
						},
						error: function (data) {
						}
					});
				}

			});

			$("#municipio_id").change(function(){
				if ($("#municipio_id").val() != "") {

					console.log($("#municipio_id option:selected").text());
				}
			});



			map = new GMaps({
				el: '#map',
				lat: -12.043333,
				lng: -77.028333
			});
			$('#geocoding_form').submit(function(e){
				e.preventDefault();

				console.log($('#address').val().trim());

				GMaps.geocode({
					address: $('#address').val().trim(),
					callback: function(results, status){
						if(status=='OK'){
							var latlng = results[0].geometry.location;
							map.setCenter(latlng.lat(), latlng.lng());
							map.removeMarkers();
							map.addMarker({
								lat: latlng.lat(),
								draggable: true,
								lng: latlng.lng(),
								dragend: function(e) {
									var lat = e.latLng.lat();
									var lng = e.latLng.lng();
									map.setCenter(lat, lng);
									document.getElementById("coords").value = lat+","+ lng;
									//alert('dragend '+lat+"->"+lng);
									//console.log(e);
								}
							});
						}
					}
				});
			});

		});

/*		var marker;          //variable del marcador
		var coords = {};    //coordenadas obtenidas con la geolocalización

		//Funcion principal
		initMap = function ()
		{

			//usamos la API para geolocalizar el usuario
			navigator.geolocation.getCurrentPosition(
					function (position){
						coords =  {
							lng: position.coords.longitude,
							lat: position.coords.latitude
						};
						setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa


					},function(error){console.log(error);});

		}



		function setMapa (coords)
		{
			//Se crea una nueva instancia del objeto mapa
			var map = new google.maps.Map(document.getElementById('map'),
					{
						zoom: 13,
						center:new google.maps.LatLng(coords.lat,coords.lng),

					});

			//Creamos el marcador en el mapa con sus propiedades
			//para nuestro obetivo tenemos que poner el atributo draggable en true
			//position pondremos las mismas coordenas que obtuvimos en la geolocalización
			marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: new google.maps.LatLng(coords.lat,coords.lng),

			});
			//agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica
			//cuando el usuario a soltado el marcador
			marker.addListener('click', toggleBounce);

			marker.addListener( 'dragend', function (event)
			{
				//escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
				document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
			});
		}

		//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
		function toggleBounce() {
			if (marker.getAnimation() !== null) {
				marker.setAnimation(null);
			} else {
				marker.setAnimation(google.maps.Animation.BOUNCE);
			}
		}*/

	</script>
	{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&callback=initMap"></script>--}}
@endsection