<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use Input;
use facilfincaraiz\Galeria;
use facilfincaraiz\User;
use facilfincaraiz\Publicacion;
use Illuminate\Support\Facades\DB;

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

    public function vistadatatable(){
        return view("pruebas.datatable");
    }

    public function getpruebadatatable(Request $request){

        

        $resultado["draw"] = isset($request->draw)? intval($request->draw): 0;


        $resultado["data"] = Publicacion::skip($request->star)->take($request->length)
                                          ->where("estado","A")
                                          ->where('titulo', 'like', "%".$request->search["value"]."%")
                                          ->orderBy($request->columns[$request->order[0]["column"]]["data"], $request->order[0]["dir"])->get();

        $resultado["recordsTotal"]= count(Publicacion::where("estado","A")->get());

        $resultado["recordsFiltered"]= count(Publicacion::where("estado","A")->where('titulo', 'like', "%".$request->search["value"]."%"));

        return $resultado;
    }


}
