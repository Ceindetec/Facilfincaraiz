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
        return view('welcome', $datos);
    }

    public function contacto()
    {
        return view("contacto");
    }
}
