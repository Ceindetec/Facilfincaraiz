<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\GaleriaPortada;

class mainController extends Controller
{
    public function index()
    {
        $imageSlider = GaleriaPortada::where('tipo', 'S')->get();
        return view('welcome', compact('imageSlider'));
    }

    public function contacto()
    {
        return view("contacto");
    }
}
