<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use Input;
use facilfincaraiz\Galeria;

class purebasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagencarga()
    {
        return view("pruebas.cargasimagenes");
    }

    public function postcargaimagen(Request $request)
    {

       dd($request->all());


    }


}
