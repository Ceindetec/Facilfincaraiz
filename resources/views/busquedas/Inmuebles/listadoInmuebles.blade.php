@if ($mensaje == "coincidencias exactas")
    <div class="alert alert-success" role="alert">
        <strong>Excelente!</strong> Tu búsqueda ha generado los siguientes '+cantidad+' resultados:
    </div>
@else
    <div class="alert alert-warning" role="alert"><strong>Lo sentimos!</strong> No hemos encontrado coincidencias exactas para tu busqueda.<br>
    @if($mensaje == "solo dpto y categoria")
        <strong>Espera:</strong> Hemos encontrado vehiculos del tipo que buscas, en el mismo departamento:
    @elseif($mensaje == "exacto sin dpto")
        <strong>Espera:</strong >Hemos encontrado vehiculos del tipo que buscas, en todo Colombia:
    @elseif($mensaje == "solo categoria")
        <strong>Espera:</strong> Hemos encontrado algunos vehiculos del tipo que buscas:
    @else
        <strong>Espera:</strong> Tambien puedes revisar nuestra lista de sugerencias:
    @endif
    </div>
@endif

<div id="listado">
@foreach($publicaciones as $publicacion)
    <div class="row tiraPublicacion bordered puntero" data-id="{{$publicacion->id}}">
        <div class="col-xs-4 conteFoto">
            <div class="foto">
                <img class="img-rounded img-responsive" src='images/publicaciones/{{$publicacion->ruta}}' alt='' style="height: 100%; width: 100%">
            </div>
        </div>
        <div class="col-xs-8">
            @if($publicacion->destacado != "")
                <div class="col-xs-9 col-xs-offset-2 text-center">
                    <div class="destacado bordered">
                        Destacado
                    </div>
                </div>
            @endif
            <div class="col-xs-12">
                <b><h3>{{ucwords($publicacion->titulo)}}</h3></b>
                <p class="marginBot10">
                    <i class="fa fa-map-marker"></i>
                    <span class="conver ubic"> {{$publicacion->municipio.", ".$publicacion->departamento}}</span>
                </p>
            </div>
            <div class="hidden-sm hidden-md hidden-lg">
                <br>&nbsp;
            </div>
            <div class="col-xs-12 precio marginBot10">
                <b><h3>$<span class="enmascarar">{{$publicacion->precio}}</span></h3></b>
            </div>
            <div class="hidden-xs marginBot10">
                <div class="col-xs-5">
                    <b>Plantas: </b>{{$publicacion->cant_plantas}}
                </div>
                <div class="col-xs-7">
                    <b>Habitaciones: </b>{{$publicacion->cant_habitaciones}}
                </div>
                <div class="col-xs-5">
                    <b>Baños: </b>{{$publicacion->cant_banos}}
                </div>
                <div class="col-xs-7">
                    <b>Garajes: </b>{{$publicacion->cant_garajes}}
                </div>
                <div class="col-xs-5">
                    <b>Estrato: </b>{{$publicacion->estrato}}
                </div>
                <div class="col-xs-7">
                    <b>Area: </b>{{$publicacion->area}}
                </div>
                @if($mensaje != "coincidencias exactas")
                    <div class="col-xs-5">
                        <b>Tipo: </b>{{$publicacion->tipo}}
                    </div>
                @endif
            </div>
            <div class="col-xs-12 text-right" style="margin-top: 10px; padding: 0">
                {{$publicacion->fecha}}
            </div>
        </div>
    </div>
@endforeach
</div>

<div id="paginacion" class="text-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="{{($pagina == 1)?'disabled':''}}">
                <a href="#" onclick="return false" aria-label="Previous" class="anterior">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @for($i=1; $i<=ceil($cantidad/10); $i++)
            <li class="{{($i==$pagina)? 'active':''}}">
                <a href="#" data-page="{{$i}}" onclick="return false" class="pagina">
                    <span>{{$i}}<span class="sr-only">(current)</span></span>
                </a>
            </li>
            @endfor
            <li class="{{($pagina == ceil($cantidad/10))?'disabled':''}}">
                <a href="#" onclick="return false" aria-label="Next" class="sgte">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>