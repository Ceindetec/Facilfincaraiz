(function ($) {


    $.fn.inputFileImage = function (option) {
        var opc = $.extend({
            width: 214,
            height: 250,
            maxlength: 10,
            maxfilesize:5120
        }, option);


        this.each(function () {
            $(this).hide();
            var arrayError = new Array();
            var elementoprimario = $(this);
            var contenedorTotal = document.createElement("div");
            contenedorTotal.setAttribute("class", "div-container-fileinput");
            var customInput= document.createElement('div');
            customInput.setAttribute("class", "custom-input-file");
            elementoprimario.after(customInput);
            var inputtextlabel = document.createElement("input");
            inputtextlabel.setAttribute("type","text");
            inputtextlabel.setAttribute("class", "input-text-label form-control");
            var cargar = document.createElement("span");
            cargar.setAttribute("class", "cargar");
            cargar.setAttribute("data-element",  $(this).attr("id"));
            cargar.innerHTML = '<i class="fa fa-folder-open" aria-hidden="true"></i>';

            $(customInput).append(elementoprimario);
            $(customInput).append(inputtextlabel);
            $(customInput).append(cargar);
            $(customInput).before(contenedorTotal);
            $(contenedorTotal).append(customInput);

            cargar.addEventListener("click",simulaclick);

            $(this).change(function (evt) {
                var files = evt.target.files; // FileList object
                if(files.length>0){
                    var error = document.createElement("div");
                    error.setAttribute("class", "alert alert-danger");
                    error.setAttribute("role","alert");
                    error.innerHTML = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    var ullisError = document.createElement("ul");
                    ullisError.setAttribute("class","ul-list-errores-flieinput");
                    $(this).data("files",[]);
                    $(this).parent(".custom-input-file").siblings(".div-contenPreviw-inputfile").remove();
                    var contenPreviw = document.createElement("output");
                    contenPreviw.setAttribute("class", "div-contenPreviw-inputfile");
                    $(this).parent(".custom-input-file").before(contenPreviw);
                    contenPreviw.innerHTML = "";
                    if(files.length <= opc.maxlength){
                        for (var i = 0, f; f = files[i]; i++) {
                            // Only process image files.
                            if (!f.type.match('image.*')) {
                                continue;
                            }
                            if((opc.maxfilesize*1024) < f.size){
                                arrayError.push('El peso de la ima imagen "'+f.name+'" supera el peso permitido '+opc.maxfilesize+'KB');
                                continue;
                            }
                            f.key =i;
                            f.elemento = $(this).attr("id");
                            filesArray = $(this).data("files");
                            filesArray.push(f);
                            $(this).data("files",filesArray);
                            var reader = new FileReader();
                            // Closure to capture the file information.
                            reader.onload = (function (theFile) {
                                return function (e) {
                                    // Render thumbnail.
                                    var divPreview = document.createElement('div');
                                    $(divPreview).addClass("div-preview-inpufile");
                                    $(divPreview).width(opc.width);
                                    $(divPreview).height(opc.height);
                                    var altoImagen = opc.height - 44;
                                    $(divPreview).append('<img class="img-thumb-preview-inpufile" src="' + e.target.result + '" title="' + escape(theFile.name) + '" width="100%" height="'+altoImagen+'"/>');
                                    var divAcciones = document.createElement('div');
                                    divAcciones.setAttribute("class", "div-acciones-preview-inpufile")
                                    var divEliminar = document.createElement('div');
                                    divEliminar.setAttribute("class","div-elimnar-preview-inpufile");
                                    divEliminar.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
                                    divEliminar.addEventListener("click",eliminarImagen);
                                    divEliminar.setAttribute("data-key",theFile.key);
                                    divEliminar.setAttribute("data-padreId",theFile.elemento);
                                    divAcciones.appendChild(divEliminar);
                                    divPreview.appendChild(divAcciones);
                                    contenPreviw.appendChild(divPreview);
                                };
                            })(f);
                            // Read in the image file as a data URL.
                            reader.readAsDataURL(f);
                        }
                    }else{
                        var lierror = document.createElement("li");
                        lierror.innerHTML = "puede subir un maximo de "+opc.maxlength+" imagenes."
                        ullisError.appendChild(lierror);
                        $(error).append(ullisError);
                        $(contenPreviw).append(error);
                    }
                }
                if(arrayError.length>0){
                    for(i=0;i<arrayError.length;i++){
                        var lierror = document.createElement("li");
                        lierror.innerHTML = arrayError[i];
                        ullisError.appendChild(lierror);
                    }
                    $(error).append(ullisError);
                    $(contenPreviw).append(error);
                }
            })
        })
        return this;
    }

    function eliminarImagen() {
        var element = this;
        $(element).parent().parent().remove();
        var key = $(this).data("key");
        var fileinput = $(this).data("padreid");
        var files = $("#"+fileinput).data("files");
        for(i=0; i < files.length; i++){
            if(files[i].key == key){
                files.splice(i,1);
                break;
            }
        }
        $("#"+fileinput).val("");
        $("#"+fileinput).data("files",files);
    }

    function simulaclick() {
        var fileinput = $(this).data("element");
        $("#"+fileinput).trigger('click');
    }

})(jQuery);
