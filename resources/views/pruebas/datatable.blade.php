@extends('layouts.principal')

@section('style')
    <link href="plugins/ceindetecFileInput/css/ceindetecFileInput.css" media="all" rel="stylesheet" type="text/css"/>

    {!!Html::style('plugins/datatables/jquery.dataTables.css')!!}

@endsection

@section('content')


    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Buscar inmueble</li>
        </ol>

        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>titulo</th>
                <th>tipo</th>
                <th>otro</th>
            </tr>
            </thead>
        </table>


    </div>

@endsection

@section('scripts')

    {!!Html::script('plugins/datatables/jquery.dataTables.js')!!}

    <script>

        $(document).ready(function() {
            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{!! route('pruebadatatable') !!}",
                    "type": "POST"
                },
                columns: [ {data:'titulo'},{data:'tipo'}],
                "columnDefs": [
                    {
                        "targets": [2],
                        "data": null,
                        "defaultContent": "<a href='adsd'  class='btn btn-primary'>Editar</a>"
                    }
                ],
                "scrollX": true
            } );
        } );

    </script>
@endsection