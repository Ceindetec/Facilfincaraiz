<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\Departamento;

class busquedasController extends Controller
{

    /////////////////////////////////////////////////////////////////////////////////
    //////// BUSQUEDA DE INMUEBLES //////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////

    /**
     * @return retorna bista inicial de los filtros de busquedas para los inmuebles
     */
    public function buscarinmuebles()
    {

        $datas = Departamento::all(["id","departamento"]);
        $items = array();
        foreach ($datas as $data)
        {
            $items[$data->id] = $data->departamento;
        }
        return view("busquedas.Inmuebles.index", compact("items"));
    }


}
