<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\GaleriaPortada;
use facilfincaraiz\Publicacion;

class mainController extends Controller
{
    public function index()
    {
        $imageSlider = GaleriaPortada::where('tipo', 'S')->get();
        $ultimasPublicaciones = Publicacion::where("estado","A")->skip(0)->take(8)->orderBy("fecha","des")->get();
        $destacados = Publicacion::where("estado","A")->where("destacado","x")->orderByRaw("RAND()")->skip(0)->take(8)->get();

        $datos =["imageSlider"=>$imageSlider, "ultimasPublicaciones"=>$ultimasPublicaciones,"destacados"=>$destacados];

        $imgInmueble=GaleriaPortada::where('tipo', 'I')->get();
        if(!$imgInmueble->isEmpty())
            $datos['imageInmueble']="images/admin/".$imgInmueble->random(1)->ruta;
        else
            $datos['imageInmueble']="images/imgInmueble.jpg";


        $imgTerreno=GaleriaPortada::where('tipo', 'T')->get();
        if(!$imgTerreno->isEmpty())
            $datos['imageTerreno']="images/admin/".$imgTerreno->random(1)->ruta;
        else
            $datos['imageTerreno']="images/imagTerreno.jpg";


        $imgVehiculo=GaleriaPortada::where('tipo', 'V')->get();
        if(!$imgVehiculo->isEmpty())
            $datos['imageVehiculo']="images/admin/".$imgVehiculo->random(1)->ruta;
        else
            $datos['imageVehiculo']="images/imagVehiculo.jpg";

        return view('welcome', $datos);
    }

    public function contacto()
    {
        return view("contacto");
    }
}
