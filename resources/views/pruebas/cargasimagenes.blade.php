@extends('layouts.principal')

@section('style')
    <link href="plugins/ceindetecFileInput/css/ceindetecFileInput.css" media="all" rel="stylesheet" type="text/css"/>

@endsection

@section('content')


    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Buscar inmueble</li>
        </ol>

        {!! Form::open(['route'=>'postcargaimagen', 'files' => true, "id"=>"formulario"]) !!}


            <input type="file" id="files" name="files[]"  multiple />



        <input type="text" name="pru">


        <button type="submit">Cargar Imagen</button>

        {!! Form::close() !!}


    </div>

@endsection

@section('scripts')
    <script src="plugins/ceindetecFileInput/js/ceindetecFileInput.js"></script>

    <script>

        $(function () {
            $("#files").inputFileImage({
                maxlength:20,
                maxfilesize:1024
            });

        })

        $("form").submit(function (event) {
            event.preventDefault();
            console.log($("#files").data("files"));
            var formData = new FormData($(this)[0]);
            var files = $("#files").data("files");
            for(i=0;i<files.length;i++){
                formData.append("imagenes[]", files[i]);
            }

            $.ajax({
                url: "{!! route('postcargaimagen') !!}",
                type: "POST",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success: function (result) {
                    console.log("success");
                },
                error: function (error) {
                    console.log("error");
                }
            });


        })


    </script>
@endsection