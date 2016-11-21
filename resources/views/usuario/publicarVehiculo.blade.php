@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
	{!!Html::style('plugins/ceindetecFileInput/css/ceindetecFileInput.css')!!}
	<style>
		#map {
			width: 100%;
			height: 200px;
		}
		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
			 cursor: pointer;
		}
	</style>


@endsection

@section('content')
	<!---->

	<div class="row">
		<div class="col-xs-12" style="margin-bottom: 30px">
			<h2 class="text-center h2Josefin">  Publicar Un Vehículo  </h2>
		</div>
	</div>


	<div class="bride-grids">
		<div class="container">

            {!!Form::open(['id'=>'formVehiculo','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}

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
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="h3Josefin text-center" style="margin-bottom: 20px;">Cargar las Imagenes para la publicación.</h3>

					<div class="form-group">
						<label for="titulo" class="col-sm-2 control-label">Imagenes</label>
						<div class="col-sm-10">
							<input type="file" id="files" name="files[]"  multiple  required style="width: 200px; height: 35px;"/>
						</div>
					</div>
				</div>
			</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tipo_id" class="col-sm-4 control-label">Categorias</label>
							<div class="col-sm-8">
								{!!Form::select('tipo_id',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Seleccione una categoria', 'required'])!!}
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
							<label for="valor" class="col-sm-4 control-label">Precio</label>
							<div class="col-sm-8">
								{!!Form::text('precio',null,['id'=> 'precio', 'class'=>'form-control','placeholder'=>"precio del Vehículo", 'required' , 'onkeypress'=>'return justNumbers(event)',"onkeyup"=>"format(this)" ,"onchange"=>"format(this)"])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6" id="col-cilindraje">
						<div class="form-group">
							<label for="cilindraje" class="col-sm-4 control-label">Cilindaje</label>
							<div class="col-sm-8">
								{!!Form::select('cilindraje',['1'=>'0 a 99 cc','2'=>'100 a 199 cc','3'=>'200 a 299 cc','4'=>'300 a 399 cc','5'=>'400 a 699 cc','6'=>'700 a 999 cc','7'=>'1000 a 1299 cc','8'=>'más de 1300 cc'], null, ['id'=>'cilindraje','class'=>"form-control"])!!}
							</div>
						</div>
					</div>
                    <div class="col-sm-6 hidden" id="col-numPuertas">
                        <div class="form-group">
                            <label for="cant_puertas" class="col-sm-4 control-label">Número Puertas</label>
                            <div class="col-sm-8">
                                {!!Form::select('cant_puertas',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['id'=>'cant_puertas','class'=>"form-control"])!!}
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="marca_id" class="col-sm-4 control-label">Marca</label>
							<div class="col-sm-8">
								{!!Form::select('marca_id',[], null, ['id'=>'marca_id','class'=>"form-control",'placeholder' => 'Seleccione una marca'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('modelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <div class="input-group-addon">
										<i class="fa fa-calendar" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" name="modelo" class="form-control pull-right" id="modelo" placeholder="Selecciona el modelo" required onkeypress="return false;" />
                                </div>
                            </div>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="kilometraje" class="col-sm-4 control-label">Kilometraje</label>
							<div class="col-sm-8">
								{!!Form::text('kilometraje',null,['class'=>'form-control','placeholder'=>"Kilometraje del vehículo", 'onkeypress'=>'return justNumbers(event)'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="color" class="col-sm-4 control-label">Color</label>
							<div class="col-sm-8">
								{!!Form::text('color',null,['id'=>'color','class'=>'form-control','placeholder'=>"Color del vehículo", 'required'])!!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="combustible" class="col-sm-4 control-label">Combustible</label>
							<div class="col-sm-8">
								{!!Form::select('combustible',['Gal'=>'Gasolina','Gas'=>'Gas','D'=>'Diesel','E'=>'Electrico','GG'=>'Gasolina y Gas','GE'=>'Gasolina y Electrico'], null, ['id'=>'combustible','class'=>"form-control"])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tipo_caja" class="col-sm-4 control-label">Tipo de Caja</label>
							<div class="col-sm-8">
								{!!Form::select('tipo_caja',['M'=>'Mecanica','S'=>'Semiautomatica','A'=>'Automatica'], null, ['class'=>"form-control"])!!}
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
								{!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento','required'])!!}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group" id="divMinucipio">
							{!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio','required'])!!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="direccion" class="col-sm-4 control-label">Dirección</label>
							<div class="col-sm-8">
								{!!Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>"calle 24A No.15 - 30"])!!}
							</div>
						</div>
					</div>
				</div>


				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Caracteristicas Adicionales</h3>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('adicinales[]', 'edicion_especial') !!} Edicion Especial
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'aire_acondicionado') !!} Aire Acondicionado
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'air_bags') !!} Air Bags
							</label>
						</div>

					</div>
					<div class="col-sm-4">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('adicinales[]', 'full_equipo') !!} Full equipo
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'planta_de_sonido') !!} Planta de sonido
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'convertible') !!} Convertible
							</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('adicinales[]', 'alarma') !!} Alarma
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'bloqueo_central') !!} Bloqueo Central
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('adicinales[]', 'vidrios_electricos') !!} Vidrios Electricos
							</label>
						</div>
					</div>
				</div>

				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Descripción general</h3>
				</div>


				<div class="row">
					<textarea id='infoAdicional' name='infoAdicional' rows='10' cols='30' style='height:440px' required></textarea>
				</div>

			<div class="row" style="margin-top: 20px;">
				<div class="col-sm-offset-2 col-sm-8">
					<div id="alert">


					</div>
				</div>
			</div>

				<div class="form-group" >
					<div class="col-sm-offset-2 col-sm-8">
						<button type="submit" class="mybutton center-block" id="submit">Publicar</button>
					</div>
				</div>
			</form>

		</div>
	</div>
	<!---->
@endsection

@section('scripts')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
	{!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}
	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	{!!Html::script('js/gmaps.js')!!}
	{!!Html::script('js/publicaciones.js')!!}
	<script charset="utf-8">
		var map;
		$(function(){
			$("#liPublicar").addClass("active");
			$("#files").inputFileImage({
				maxlength:8,
				width:120,
				height: 140,
				maxfilesize:2048
			});

			CKEDITOR.replace('infoAdicional', {removeButtons:'Image'});
			$("#tipoArticulo").change(function(){
				console.log($(this).val());
			});

			$.fn.datepicker.dates['es'] = {
				days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
				daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
				daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
				months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
				monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				today: "Hoy",
				clear: "Clear",
				format: "yyyy/mm/dd",
				titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
				weekStart: 0
			};
			$('#modelo').datepicker({
				autoclose: true,
				format: "yyyy",
				startView: "year",
				minView: "year",
				minViewMode: "years",
				language: 'es',
				endDate:''+(new Date().getFullYear()+1),
				startDate: ''+(new Date().getFullYear()-50)
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

            $("#categorias").change(function () {
//console.log($("#categorias option:selected").text());


                if($("#categorias option:selected").text()=='Moto'||$("#categorias option:selected").text()=='Moto-Carro'||$("#categorias option:selected").text()=='Cuatrimoto'){

                    $("#col-numPuertas").addClass("hidden");
                    $("#col-cilindraje").removeClass("hidden");
					$(".noMoto").addClass("hidden");
                    llenarMarca("M");
                }else{
                    $("#col-cilindraje").addClass("hidden");
                    $("#col-numPuertas").removeClass("hidden");
					$(".noMoto").removeClass("hidden");
                    llenarMarca("C");

                }
            });

			var formulario = $("#formVehiculo");
			formulario.submit(function(e){
				e.preventDefault();
				//var contenido = encodeURIComponent(CKEDITOR.instances.infoAdicional.getData().split("\n").join(""));
				var contenido = CKEDITOR.instances.infoAdicional.getData().split("\n").join("");
				//console.log($("#files").data("files"));
				var formData = new FormData($(this)[0]);
				var files = $("#files").data("files");
				for(i=0;i<files.length;i++){
					formData.append("imagenes[]", files[i]);
				}
				formData.append("descripcion", contenido);
				formData.append("precio", desenmascarar($("#precio").val()));

				$.ajax({
					url: "{!! route('publicarVehiculo') !!}",
					type: "POST",
					data: formData,
					processData: false,  // tell jQuery not to process the data
					contentType: false,   // tell jQuery not to set contentType
					success: function (result) {
						if(result.estado){
							$("#submit").attr("disabled", true);
							alert("success","Perfecto","Su publicacion fue enviada con exito","<i class='fa fa-check' aria-hidden='true'></i>");
							setTimeout(function(){
								window.location="../publicar";
							}, 3000);


						}else{
							alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
						}

					},
					error: function (error) {
						alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
						console.log(error);
					}
				});

			});

		});

        function llenarMarca(tipo) {

            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('marcas')}}',
                data: { 'tipo' : tipo},
                success: function (data) {
                    $("#marca_id").empty();
                    $.each(data,function (index,valor) {
                        $("#marca_id").append('<option value='+index+'>'+valor+'</option>');
                    });
                },
                error: function (data) {
                }
            });
        }

		function alert(tipo,titulo,mensaje,icono) {
			$("#alert").empty();
			var html ="<div class='alert alert-"+tipo+"'>"+
					"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+
					icono+"<strong>"+titulo+"!</strong> "+mensaje+
					"</div>";
			$("#alert").append(html)
		}
	</script>
	{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&callback=initMap"></script>--}}
@endsection