<div class="row">
@foreach($marcaDA as $item)
    <div class="col-sm-6">
        <div class="panel panel-default userEmail" data-email="{{$item->getUsuario->email}}">
            <div class="panel-body">
                <div class="col-md-4 text-center">
                    <div class="divConteMarcaDA">
                        <div class="contemarca">
                            <img src="images/marcasDeAgua/{{$item->ruta}}"
                                 class="img-responsive imagen" id="imagen" alt=""
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-xs-2 text-right"><i class="fa fa-user"
                                                            aria-hidden="true"></i></div>
                        <div class="col-xs-10" id="nombres"> {{$item->getUsuario->nombres." ".$item->getUsuario->apellidos}}</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 text-right"><i class="fa fa-phone"
                                                            aria-hidden="true"></i></div>
                        <div class="col-xs-10" id="telefono"> {{$item->getUsuario->telefono}}</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 text-right"><i class="fa fa-envelope"
                                                            aria-hidden="true"></i></div>
                        <div class="col-xs-10" id="email"> {{$item->getUsuario->email}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach
</div>
<div class="row text-center">
    {!! $marcaDA->render() !!}
</div>