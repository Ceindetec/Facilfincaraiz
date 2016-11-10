@extends('layouts.principal')

@section('style')

    {!!Html::style('plugins/datatables/media/css/dataTables.bootstrap.css')!!}
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
            <li class="active">Registro</li>
        </ol>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <table id="tablaPublicaciones" class="table table-striped table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Tipo</th>
                        <th>Acción</th>
                        <th>ver</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>



    </div>
    <!---->
@endsection

@section('scripts')

    {!!Html::script('plugins/datatables/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/datatables/media/js/dataTables.bootstrap.min.js')!!}
    <script>
        var table;
        $(function(){
            $("#liPublicaciones").addClass("active");
            table=  $('#tablaPublicaciones').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{!! route('inactivas') !!}",
                    "type": "POST"
                },
                columns: [ {data:'titulo'},{data:'tipo'},{data:'accion'}],
                "columnDefs": [
                    {
                        "targets": [3],
                        "data": null,
                        "defaultContent": "<a href='#' onclick='return false;' class='btn btn-primary validar'>Editar</a>"
                    }
                ],
                "scrollX": true
            } );




        });


        $("#tablaPublicaciones").on("click",".validar",function () {

            var publicacion= table.row( $(this).parents('tr') );
            if(publicacion.data()["tipo"]=="Inmueble"){
                window.location= "validarPublicInmueble/"+publicacion.data()["id"];
            }else if(publicacion.data()["tipo"]=="Vehículo"){
                window.location= "validarPublicVehiculo/"+publicacion.data()["id"];
            }else{
                window.location= "validarPublicTerreno/"+publicacion.data()["id"];
            }
        });


    </script>



@endsection