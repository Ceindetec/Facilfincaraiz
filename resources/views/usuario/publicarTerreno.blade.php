@extends('layouts.principal')

@section('style')

	<style>
		#map {
			width: 100%;
			height: 200px;
		}
	</style>

@endsection

@section('content')
	<!---->

	<div class="row">
		<div class="col-xs-12" style="margin-bottom: 30px">
			<h2 class="text-center h2Josefin"> Publicar Un Terreno </h2>
		</div>
	</div>

	<div class="bride-grids">
		<div class="container">
            {!!Form::open(['id'=>'formTerreno','class'=>'form-horizontal','autocomplete'=>'off'])!!}
				<div class="row">
					<div class="col-sm-offset-2 col-sm-8">
						<div class="form-group">
							<label for="titulo" class="col-sm-2 control-label">Titulo</label>
							<div class="col-sm-10">
                                {!!Form::text('titulo',null,['class'=>'form-control','placeholder'=>"Titulo", 'required'])!!}
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tipo_id" class="col-sm-4 control-label">Categorias</label>
							<div class="col-sm-8">
								{!!Form::select('tipo_id',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Seleccione una categoria'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="accion" class="col-sm-4 control-label">Acción</label>
							<div class="col-sm-8">
								{!!Form::select('accion',['V'=>'Vender','A'=>'Arrendar','P'=>'Permutar'], null, ['class'=>"form-control"])!!}
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="precio" class="col-sm-4 control-label">Precio</label>
							<div class="col-sm-8">
								{!!Form::text('precio',null,['class'=>'form-control','placeholder'=>"precio del terreno", 'required'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="estrato" class="col-sm-4 control-label">Estrato</label>
							<div class="col-sm-8">
								{!!Form::select('estrato',['1'=>'Estrato 1','2'=>'Estrato 2','3'=>'Estrato 3','4'=>'Estrato 4','5'=>'Estrato 5','6'=>'Estrato 6'], null, ['class'=>"form-control"])!!}
							</div>
						</div>
					</div>
				</div>


				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Dimensiones</h3>
				</div>


				<div class="row" id="rowDimenciones">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="frente" class="col-sm-4 control-label">Frente (m)</label>
							<div class="col-sm-8">
								{!!Form::text('frente',null,['id'=>'frente','class'=>'form-control','placeholder'=>"metros de frente", 'required'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="fondo" class="col-sm-4 control-label">Fondo (m)</label>
							<div class="col-sm-8">
								{!!Form::text('fondo',null,['id'=>'fondo','class'=>'form-control','placeholder'=>"metros de fondo", 'required'])!!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="area" class="col-sm-4 control-label">Area total</label>
							<div class="col-xs-8 col-sm-6">
								{!!Form::text('area',null,['id'=>"area",'class'=>'form-control','placeholder'=>"area total metros cuadrados", 'required'])!!}
							</div>
                            <div class="col-xs-4 col-sm-2">
                                {!!Form::select('umedida', ['m'=>'m2','h'=>'hta'], null, ['class'=>"form-control",'id'=>"umedida"])!!}
                            </div>
						</div>
					</div>

				</div>

				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Ubicación</h3>
				</div>


				<div class="row">
					<div class="col-sm-6">
						<div class="form-group" style="margin-top: 20px;">
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
							<label for="direccion" class="col-sm-4 control-label">Dirección</label>
							<div class="col-sm-8">
								{!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>"calle 24A No.15 - 30",])!!}
							</div>
						</div>
						<div class="form-group">
							<label for="coords" class="col-sm-4 control-label">Geolocalización</label>
							<div class="col-sm-8">
								{!!Form::text('coords',null,['class'=>'form-control','id'=>'coords','disabled'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6" style="color:#00a0dc; margin-bottom: 20px;">

						<div id="map"></div>
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						arrastra el marcador a la posición deseada

					</div>
				</div>

				<div id="tituloAdicionales" class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Caracteristicas Adicionales</h3>
				</div>


				<div id="adicionales" class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal1', 'agua') !!} Agua
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal2', 'luz') !!} Luz
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal3', 'gas') !!} Gas
                                </label>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal4', 'conjunto_cerrado') !!} Conjunto Cerrado
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal5', 'condominio') !!} Condominio
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('adicinal6', 'proyecto_de_vivienda') !!} Terreno para proyecto de vivienda
                                </label>
                            </div>
                        </div></div>
                    </div>
				</div>

				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Descripción general</h3>
				</div>


				<div class="row">
                    <textarea id='infoAdicional' name='infoAdicional' rows='10' cols='30' style='height:440px'></textarea>
				</div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1" id="error"></div>
            </div>

				<div class="form-group" style="margin-top: 30px;">
					<div class="col-sm-offset-2 col-sm-8">
						<button type="submit" class="mybutton center-block">Publicar</button>
					</div>
				</div>
			</form>

		</div>
	</div>
	<!---->
@endsection

@section('scripts')
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&sensor=true"></script>
	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	{!!Html::script('js/gmaps.js')!!}
	<script charset="utf-8">
		var map;
		$(function(){
			CKEDITOR.replace('infoAdicional', {removeButtons:'Image'});
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
							//console.log($("#municipio_id option:selected").text()+" "+$("#departamento option:selected").text());
							geoMapa($("#municipio_id option:selected").text()+" "+$("#departamento option:selected").text());
						},
						error: function (data) {
						}
					});
				}

			});

			$("#municipio_id").change(function(){
				if ($("#municipio_id").val() != "") {

					//console.log($("#municipio_id option:selected").text()+" "+$("#departamento option:selected").text());
					geoMapa($("#municipio_id option:selected").text()+" "+$("#departamento option:selected").text());
				}
			});



			map = new GMaps({
				el: '#map',
				lat: -12.043333,
				lng: -77.028333
			});

            $("#umedida").change(function () {
                console.log($(this).val());
                if($(this).val()=='m'){
                    if($("#area")==""){
                        $("#area").attr('placeholder','area total en metros cuadrados');
                    }else {
                        var valor =$("#area").val();
                        $("#area").val(valor*10000);
                    console.log(valor+"->"+($("#area").val()*10000)+" ->" +($("#area").val())*10000);
                       // $("#area").val();
                    }

                }else{
                    if($("#area")=="") {
                        $("#area").attr('placeholder','area total en Hectareas');
                    }else{
                        var valor =$("#area").val();
                        $("#area").val(parseFloat(valor/10000));
                        console.log(valor+"->"+($("#area").val()/10000)+" ->" +parseFloat($("#area").val()/10000));
                        //$("#area").val(Math.floor($("#area").val()/10000));
                    }

                }
            });


            $("#categorias").change(function () {

                $("#tituloAdicionales").removeClass("hidden");
                $("#adicionales").removeClass("hidden");

                if($("#categorias option:selected").text()=='Grandes terrenos'){
                    $("#rowDimenciones").addClass("hidden");
                }else{
                    $("#rowDimenciones").removeClass("hidden");
                    if($("#categorias option:selected").text()=='Parcelas cementerios'){
                        $("#tituloAdicionales").addClass("hidden");
                        $("#adicionales").addClass("hidden");
                    }
                }
            });
            
            $("#frente").change(function () {
                if(($(this).val()!=""&&$(this).val()>0)&&($("#fondo")!=""&&$("#fondo").val()>0)){
                    console.log($(this).val()*$("#fondo").val());
                    $("#area").val($(this).val()*$("#fondo").val());
                    $("#umedida").val("m");
                }
            });
            
            $("#fondo").change(function () {
                if(($(this).val()!=""&&$(this).val()>0)&&($("#frente")!=""&&$("#frente").val()>0)){
                    console.log($(this).val()*$("#frente").val());
                    $("#area").val($(this).val()*$("#frente").val());
                    $("#umedida").val("m");
                }
            });

            var formulario = $("#formTerreno");
            formulario.submit(function(e){
                e.preventDefault();
                var contenido = encodeURIComponent(CKEDITOR.instances.infoAdicional.getData().split("\n").join(""));
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('publicarInmueble')}}',
                    data:formulario.serialize()+"&descripcion="+contenido,
                    success: function(data){
                        console.log(data);
                        if (data=="exito") {

                        }
                        else {

                        }
                    },
                    error: function(data){
                        var respuesta =JSON.parse(data.responseText);
                        var arr = Object.keys(respuesta).map(function(k) { return respuesta[k] });
                        var error='<ul>';
                        for (var i=0; i<arr.length; i++)
                            error += "<li>"+arr[i][0]+"</li>";
                        error += "</ul>";
                        $("#error").html('<div class="alert alert-danger">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Error!</strong> Corrige los siguientes errores para continuar el registro:' +
                                '<p>'+error+'</p>' +
                                '</div>');
                    }
                });
            });
            

		});

		function geoMapa($muniDepartamento){
			GMaps.geocode({
				address: $muniDepartamento,
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
		}


	</script>
@endsection