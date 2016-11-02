@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/datepicker/datepicker3.css')!!}
    <style>
        #modelo{
            cursor: pointer;
        }
        .mybutton{
            padding: 10px 15px 10px 15px;
            border-radius: 5px;
        }
    </style>

@endsection

@section('content')


    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Buscar vehiculo</li>
        </ol>
        <div class="welcome-left col-md-12 col-lg-12 col-xs-12 col-sm-12 text-center" style="margin-bottom: 2%">
            <h2>Encuetra lo que necesitas</h2>
            <h3>fácil, rápido y seguro</h3>
        </div>

        {!!Form::open(['route'=>'getVehiculos','id'=>'formVehiculo','autocomplete'=>'off'])!!}
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    {!!Form::select('categorias',$arrayCategorias, null, ['id'=>'categorias','class'=>"form-control",'placeholder' => 'Selecciona una categoria', 'required'])!!}
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    {!!Form::select('marca',[], null, ['id'=>'marca','class'=>"form-control",'placeholder' => 'Selecciona una marca'])!!}
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                <div class="form-group">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        {!!Form::text('modelo', null, ['id'=>'modelo','class'=>"form-control pull-right",'placeholder' => 'Selecciona un modelo', 'readonly'])!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
                <div class="form-group">
                    {!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Selecciona un departamento', 'required', 'id' => 'departamento'])!!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    {!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecciona un municipio', 'id'=>'municipio_id'])!!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="mybutton center-block">Buscar</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!!Html::script('plugins/datepicker/bootstrap-datepicker.js')!!}
    <script>
        $(function(){
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
                    $("#municipio_id").empty();
                    $("#municipio_id").append("<option value=''>Selecciona un municipio</option>");
                }else{
                    //alert("el id es "+$("#departamento").val());
                    $.ajax({
                        type: "POST",
                        context: document.body,
                        url: '{{route('municipios')}}',
                        data: { 'id' : $("#departamento").val()},
                        success: function (data) {

                            $("#municipio_id").empty();
                            $("#municipio_id").append("<option value=''>Cualquier municipio</option>");
                            $.each(data,function (index,valor) {
                                $("#municipio_id").append('<option value='+index+'>'+valor+'</option>');
                            });

                        },
                        error: function (data) {
                        }
                    });
                }

            });

            $("#categorias").change(function () {
                var selected = $("#categorias option:selected").text();
//                console.log(selected);
                if(selected=='Moto'||selected=='Moto-Carro'||selected=='Cuatrimoto')
                    llenarMarca("M");
                else
                    llenarMarca("C");
            });

        });

        function llenarMarca(tipo) {
            if($("#categorias").val()==""){
                $("#marca").empty();
                $("#marca").append("<option value=''>Selecciona una marca</option>");
            }else {
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('marcas')}}',
                    data: {'tipo': tipo},
                    success: function (data) {
                        $("#marca").empty();
                        $("#marca").append("<option value=''>Cualquier marca</option>");
                        $.each(data, function (index, valor) {
                            $("#marca").append('<option value=' + index + '>' + valor + '</option>');
                        });
                    },
                    error: function (data) {
                    }
                });
            }
        }
    </script>

@endsection