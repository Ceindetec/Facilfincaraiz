@extends('layouts.principal')

@section('style')
    <link href="plugins/bootstrapFileInput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <style>
        .feature-grid {
            padding: 0 1em 0 1em;
        }

        .eliminar {
            background-color: rgba(195, 195, 195, 0.46);
            border-radius: 50%;
            padding: 5px;
        }

        .feature-grid img {
            padding: 0;
        }

        .editProfPic {
            position: absolute;
            bottom: 0;
            z-index: 1;
            text-align: right;
            padding-bottom: 9px;
            color: #0c0c0c;
            right: 0;
            padding-right: 15px;
        }

        @media (max-width: 320px) {
            .feature-grid img {
                height: 155px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 321px) and (max-width: 585px) {
            .feature-grid img {
                height: 150px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 586px) and (max-width: 640px) {
            .feature-grid img {
                height: 200px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .feature-grid img {
                height: 150px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 769px) {
            .feature-grid img {
                height: 200px;
                padding-bottom: 10px;
            }
        }

        .manito {
            cursor: pointer;
        }

        .popover-content {
            width: 125px;
        }
    </style>
@endsection

@section('content')
    <!---->
    <div class="login_sec">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route("home")}}">Inicio</a></li>
                <li class="active">Administrar</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Banner Principal</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 log">
                        <p>Carga las imagenes de tu preferencia para el banner de la pagina principal.</p>
                    </div>
                    <div id="imgsSliders" class="feature-grids">
                        @for($i=0;$i<count($imageSlider);$i++)
                            <div class="col-md-3 feature-grid"
                                 data-id={{$imageSlider[$i]->id}} data-ruta={{$imageSlider[$i]->ruta}}>
                                <div class="editProfPic">
                                    <i class='fa fa-trash fa-2x eliminar eliminarS manito' aria-hidden='true'
                                       data-toggle='confirmation' data-popout="true" data-placement='top'
                                       title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                </div>
                                <img src="images/admin/{{$imageSlider[$i]->ruta}}" alt="">
                            </div>
                        @endfor
                    </div>

                    <div class="row">
                        <div class="col-xs-12" id="divUploadImages">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <br>

            {{--        <h2>Banner Principal</h2>
                    <div class="col-md-12 log">
                        <p>Carga las imagenes de tu preferencia para el banner de la pagina principal.</p>
                    </div>
                    <div class="feature-grids">
                        @for($i=0;$i<count($imageSlider);$i++)
                            <div class="col-md-3 feature-grid" data-id={{$imageSlider[$i]->id}} data-ruta={{$imageSlider[$i]->ruta}}>
                                <div class="editProfPic">
                                    <i class='fa fa-trash fa-2x eliminar manito' aria-hidden='true' data-toggle='confirmation' data-popout="true" data-placement='top' title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                </div>
                                <img src="images/admin/{{$imageSlider[$i]->ruta}}" alt="">
                            </div>
                        @endfor
                    </div>

                    <div class="row">
                        <div class="col-xs-12" id="divUploadImages">
                        </div>
                    </div>

                    <div class="clearfix"></div>--}}


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Imagenes de las Categorias</h2>
                </div>
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center" style="color: #e8573e">Imagenes para la categoria de Inmuebles</h3>
                            </div>
                                <div id="imgsInmuebles" class="feature-grids">
                                    @foreach($imageInmuebles as $imageInmueble)
                                        <div class="col-md-3 feature-grid"
                                             data-id={{$imageInmueble->id}} data-ruta={{$imageInmueble->ruta}}>
                                            <div class="editProfPic">
                                                <i class='fa fa-trash fa-2x eliminar eliminarI manito' aria-hidden='true'
                                                   data-toggle='confirmation' data-popout="true" data-placement='top'
                                                   title='Eliminar?' data-btn-ok-label="Si"
                                                   data-btn-cancel-label="No"></i>
                                            </div>
                                            <img src="images/admin/{{$imageInmueble->ruta}}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" id="divInmueblesImages">
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center" style="color: #e8573e">Imagenes para la categoria de Terrenos</h3>
                            </div>
                            <div id="imgsTerrenos" class="feature-grids">
                                @foreach($imageTerrenos as $imageTerreno)
                                    <div class="col-md-3 feature-grid"
                                         data-id={{$imageTerreno->id}} data-ruta={{$imageTerreno->ruta}}>
                                        <div class="editProfPic">
                                            <i class='fa fa-trash fa-2x eliminar eliminarT manito' aria-hidden='true'
                                               data-toggle='confirmation' data-popout="true" data-placement='top'
                                               title='Eliminar?' data-btn-ok-label="Si"
                                               data-btn-cancel-label="No"></i>
                                        </div>
                                        <img src="images/admin/{{$imageTerreno->ruta}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-xs-12" id="divTerrenosImages">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h3 class="text-center" style="color: #e8573e">Imagenes para la categoria de Vehiculos</h3>
                            </div>
                            <div id="imgsVehiculos" class="feature-grids">
                                @foreach($imageVehiculos as $imageVehiculo)
                                    <div class="col-md-3 feature-grid"
                                         data-id={{$imageVehiculo->id}} data-ruta={{$imageVehiculo->ruta}}>
                                        <div class="editProfPic">
                                            <i class='fa fa-trash fa-2x eliminar eliminarV manito' aria-hidden='true'
                                               data-toggle='confirmation' data-popout="true" data-placement='top'
                                               title='Eliminar?' data-btn-ok-label="Si"
                                               data-btn-cancel-label="No"></i>
                                        </div>
                                        <img src="images/admin/{{$imageVehiculo->ruta}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-xs-12" id="divVehiculosImages">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!---->
@endsection

@section('scripts')
    <script src="plugins/bootstrapConfirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script src="plugins/bootstrapFileInput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="plugins/bootstrapFileInput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="plugins/bootstrapFileInput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="plugins/bootstrapFileInput/js/fileinput.min.js"></script>
    <script src="plugins/bootstrapFileInput/js/locales/es.js"></script>
    <script>
        var totalGaleria = 0;
        var totalInmuebles = 0;
        var totalTerrenos = 0;
        var totalVehiculos = 0;

        $(function () {
            totalGaleria = "{!!count($imageSlider)!!}";
            totalInmuebles = "{!!count($imageInmuebles)!!}";
            totalTerrenos = "{!!count($imageTerrenos)!!}";
            totalVehiculos = "{!!count($imageVehiculos)!!}";

            validarUpload(totalGaleria);
            validarInmuebles(totalInmuebles);
            validarTerrenos(totalTerrenos);
            validarVehiculos(totalVehiculos);

            eliminarImgSlider();
            eliminarImgInmueble();
            eliminarImgTerreno();
            eliminarImgVehiculo();


        });


        function validarUpload($cantImagenes) {
            if ($cantImagenes != 6) {
                $("#divUploadImages").html("<div class='tema'>" +
                        "<label class='control-label'>Seleccionar archivos</label>" +
                        "<input id='inputGalery' name='inputGalery[]' type='file'  multiple class='file-loading' accept='image/*'>" +
                        "</div>");
                imagesUploaded = 0;
                $("#inputGalery").fileinput({
                    uploadAsync: true,
                    uploadUrl: '{{route("subirImagen")}}',
                    language: "es",
                    maxFileCount: 6 - (totalGaleria),
                    showUpload: true,
                    uploadExtraData: {tipo: "S"},
                    previewFileType: 'image',
                    allowedFileTypes: ['image'],
                    allowedFileExtensions: ['jpg', 'gif', 'png'],
                    previewSettings: {image: {width: "200px", height: "160px"}},
                    minImageWidth: 500,
                    minImageHeight: 500,
                    maxFileSize: 2048
                }).on('fileuploaded', function (e, params) {
                    imagesUploaded++;
                    $("#imgsSliders").append("<div class='col-md-3 feature-grid' data-id='" + params.response.id + "' data-ruta='" + params.response.ruta + "'>" +
                            "<div class='editProfPic'>" +
                            "<i class='fa fa-trash fa-2x eliminar eliminarS manito' aria-hidden='true' data-toggle='confirmation' data-popout='true' data-placement='top' title='Eliminar?' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                            "</div>" +
                            "<img src='images/admin/" + params.response.ruta + "' alt=''>" +
                            "</div>");
                    eliminarImgSlider();
                    if (imagesUploaded == params.files.length) {
                        totalGaleria = parseInt(totalGaleria) + parseInt(imagesUploaded);
                        validarUpload(totalGaleria);
                    }
                });
            }
            else
                $("#divUploadImages").html("");
        }
        function validarInmuebles($cantImagenes) {
            if ($cantImagenes != 6) {
                $("#divInmueblesImages").html("<div class='tema'>" +
                        "<label class='control-label'>Seleccionar archivos</label>" +
                        "<input id='inputInmueble' name='inputGalery[]' type='file'  multiple class='file-loading' accept='image/*'>" +
                        "</div>");
                imagesUploaded = 0;
                $("#inputInmueble").fileinput({
                    uploadAsync: true,
                    uploadUrl: '{{route("subirImagen")}}',
                    language: "es",
                    maxFileCount: 6 - (totalInmuebles),
                    showUpload: true,
                    uploadExtraData: {tipo: "I"},
                    previewFileType: 'image',
                    allowedFileTypes: ['image'],
                    allowedFileExtensions: ['jpg', 'gif', 'png'],
                    previewSettings: {image: {width: "200px", height: "160px"}},
                    minImageWidth: 400,
                    minImageHeight: 200,
                    maxImageWidth: 600,
                    maxImageHeight: 400,
                    maxFileSize: 2048
                }).on('fileuploaded', function (e, params) {
                    imagesUploaded++;
                    $("#imgsInmuebles").append("<div class='col-md-3 feature-grid' data-id='" + params.response.id + "' data-ruta='" + params.response.ruta + "'>" +
                            "<div class='editProfPic'>" +
                            "<i class='fa fa-trash fa-2x eliminar eliminarI manito' aria-hidden='true' data-toggle='confirmation' data-popout='true' data-placement='top' title='Eliminar?' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                            "</div>" +
                            "<img src='images/admin/" + params.response.ruta + "' alt=''>" +
                            "</div>");
                    eliminarImgInmueble();
                    if (imagesUploaded == params.files.length) {
                        totalInmuebles = parseInt(totalInmuebles) + parseInt(imagesUploaded);
                        validarInmuebles(totalInmuebles);
                    }
                });
            }
            else
                $("#divUploadImages").html("");
        }

        function validarTerrenos($cantImagenes) {
            if ($cantImagenes != 6) {
                $("#divTerrenosImages").html("<div class='tema'>" +
                        "<label class='control-label'>Seleccionar archivos</label>" +
                        "<input id='inputTerreno' name='inputGalery[]' type='file'  multiple class='file-loading' accept='image/*'>" +
                        "</div>");
                imagesUploaded = 0;
                $("#inputTerreno").fileinput({
                    uploadAsync: true,
                    uploadUrl: '{{route("subirImagen")}}',
                    language: "es",
                    maxFileCount: 6 - (totalTerrenos),
                    showUpload: true,
                    uploadExtraData: {tipo: "T"},
                    previewFileType: 'image',
                    allowedFileTypes: ['image'],
                    allowedFileExtensions: ['jpg', 'gif', 'png'],
                    previewSettings: {image: {width: "200px", height: "160px"}},
                    minImageWidth: 400,
                    minImageHeight: 200,
                    maxImageWidth: 600,
                    maxImageHeight: 400,
                    maxFileSize: 2048
                }).on('fileuploaded', function (e, params) {
                    imagesUploaded++;
                    $("#imgsTerrenos").append("<div class='col-md-3 feature-grid' data-id='" + params.response.id + "' data-ruta='" + params.response.ruta + "'>" +
                            "<div class='editProfPic'>" +
                            "<i class='fa fa-trash fa-2x eliminar eliminarT manito' aria-hidden='true' data-toggle='confirmation' data-popout='true' data-placement='top' title='Eliminar?' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                            "</div>" +
                            "<img src='images/admin/" + params.response.ruta + "' alt=''>" +
                            "</div>");
                    eliminarImgTerreno();
                    if (imagesUploaded == params.files.length) {
                        totalTerrenos = parseInt(totalTerrenos) + parseInt(imagesUploaded);
                        validarTerrenos(totalTerrenos);
                    }
                });
            }
            else
                $("#divUploadImages").html("");
        }
        function validarVehiculos($cantImagenes) {
            if ($cantImagenes != 6) {
                $("#divVehiculosImages").html("<div class='tema'>" +
                        "<label class='control-label'>Seleccionar archivos</label>" +
                        "<input id='inputVehiculo' name='inputGalery[]' type='file'  multiple class='file-loading' accept='image/*'>" +
                        "</div>");
                imagesUploaded = 0;
                $("#inputVehiculo").fileinput({
                    uploadAsync: true,
                    uploadUrl: '{{route("subirImagen")}}',
                    language: "es",
                    maxFileCount: 6 - (totalVehiculos),
                    showUpload: true,
                    uploadExtraData: {tipo: "V"},
                    previewFileType: 'image',
                    allowedFileTypes: ['image'],
                    allowedFileExtensions: ['jpg', 'gif', 'png'],
                    previewSettings: {image: {width: "200px", height: "160px"}},
                    minImageWidth: 400,
                    minImageHeight: 200,
                    maxImageWidth: 600,
                    maxImageHeight: 400,
                    maxFileSize: 2048
                }).on('fileuploaded', function (e, params) {
                    imagesUploaded++;
                    $("#imgsVehiculos").append("<div class='col-md-3 feature-grid' data-id='" + params.response.id + "' data-ruta='" + params.response.ruta + "'>" +
                            "<div class='editProfPic'>" +
                            "<i class='fa fa-trash fa-2x eliminar eliminarV manito' aria-hidden='true' data-toggle='confirmation' data-popout='true' data-placement='top' title='Eliminar?' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                            "</div>" +
                            "<img src='images/admin/" + params.response.ruta + "' alt=''>" +
                            "</div>");
                    eliminarImgVehiculo();
                    if (imagesUploaded == params.files.length) {
                        totalVehiculos = parseInt(totalVehiculos) + parseInt(imagesUploaded);
                        validarVehiculos(totalVehiculos);
                    }
                });
            }
            else
                $("#divUploadImages").html("");
        }
        function ajaxEliminarImagen(elemento) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('deleteImgBanner')}}',
                data: "&id=" + elemento.attr('data-id') + "&ruta=" + elemento.attr('data-ruta'),
                success: function (data) {
                    if (data == "exito") {
                        elemento.remove();
                    }
                },
                error: function (data) {
                }
            });
        }

        function eliminarImgSlider() {
            $(".eliminarS").each(function () {
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).parent().parent());
                        totalGaleria--;
                        validarUpload(totalGaleria);
                    }
                });
            });
        }
        function eliminarImgInmueble() {
            $(".eliminarI").each(function () {
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).parent().parent());
                        totalInmuebles--;
                        validarInmuebles(totalInmuebles);
                    }
                });
            });
        }
        function eliminarImgTerreno() {
            $(".eliminarT").each(function () {
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).parent().parent());
                        totalTerrenos--;
                        validarTerrenos(totalTerrenos);
                    }
                });
            });
        }
        function eliminarImgVehiculo() {
            $(".eliminarV").each(function () {
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).parent().parent());
                        totalVehiculos--;
                        validarVehiculos(totalVehiculos);
                    }
                });
            });
        }
    </script>
@endsection