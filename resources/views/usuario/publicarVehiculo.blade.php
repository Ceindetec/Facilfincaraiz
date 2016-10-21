@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
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

            {!!Form::open(['id'=>'formVehiculo','class'=>'form-horizontal','autocomplete'=>'off'])!!}

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
							<label for="categorias" class="col-sm-4 control-label">Categorias</label>
							<div class="col-sm-8">
								{!!Form::select('categorias',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Seleccione una categoria'])!!}
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
								{!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>"precio del inmueble", 'required'])!!}
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
                            <label for="cant_banos" class="col-sm-4 control-label">Número Puertas</label>
                            <div class="col-sm-8">
                                {!!Form::select('cant_banos',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4+'], null, ['id'=>'cant_banos','class'=>"form-control"])!!}
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="marca" class="col-sm-4 control-label">Marca</label>
							<div class="col-sm-8">
								{!!Form::select('marca',[], null, ['id'=>'marca','class'=>"form-control",'placeholder' => 'Seleccione una marca'])!!}
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
                                    <input type="text" name="modelo" class="form-control pull-right" id="modelo" placeholder="Selecciona una fecha..." readonly required>
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
								{!!Form::text('kilometraje',null,['class'=>'form-control','placeholder'=>"precio del inmueble", 'required'])!!}
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="color" class="col-sm-4 control-label">Color</label>
							<div class="col-sm-8">
								{!!Form::text('color',null,['id'=>'color','class'=>'form-control','placeholder'=>"precio del inmueble", 'required'])!!}
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
								{!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento'])!!}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group" id="divMinucipio">
							{!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio'])!!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="direccion" class="col-sm-4 control-label">Dirección</label>
							<div class="col-sm-8">
								{!!Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>"calle 24A No.15 - 30", 'required'])!!}
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
								{!! Form::checkbox('name', 'edicion_especial') !!} Edicion Especial
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'aire_acondicionado') !!} Aire Acondicionado
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'air_bags') !!} Air Bags
							</label>
						</div>

					</div>
					<div class="col-sm-4">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('name', 'full_equipo') !!} Full equipo
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'planta_de_sonido') !!} Planta de sonido
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'convertible') !!} Convertible
							</label>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('name', 'alarma') !!} Alarma
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'bloqueo_central') !!} Bloqueo Central
							</label>
						</div>
						<div class="checkbox noMoto">
							<label>
								{!! Form::checkbox('name', 'vidrios_electricos') !!} Vidrios Electricos
							</label>
						</div>
					</div>
				</div>

				<div class="row" style="margin: 15px 0">
					<h3 class="h3Josefin text-center">Descripción general</h3>
				</div>


				<div class="row">
					<textarea id='infoAdicional' name='infoAdicional' rows='10' cols='30' style='height:440px'></textarea>
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
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	{!!Html::script('js/gmaps.js')!!}
	<script>
		var map;
		$(function(){
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
				endDate:''+(new Date().getFullYear()+1)
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
console.log($("#categorias option:selected").text());


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
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('publicarInmueble')}}',
                    data:formulario.serialize(),
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

        function llenarMarca(tipo) {

            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('marcas')}}',
                data: { 'tipo' : tipo},
                success: function (data) {
                    $("#marca").empty();
                    $.each(data,function (index,valor) {
                        $("#marca").append('<option value='+index+'>'+valor+'</option>');
                    });
                },
                error: function (data) {
                }
            });
        }

	</script>
	{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&callback=initMap"></script>--}}
@endsection