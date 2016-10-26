<?php

namespace facilfincaraiz\Http\Controllers;

use facilfincaraiz\Publicacion;
use facilfincaraiz\Tipo;
use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\Departamento;

class busquedasController extends Controller
{

    /////////////////////////////////////////////////////////////////////////////////
    ///////////////////////// BUSQUEDA DE VEHICULOS /////////////////////////////////
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

    /**
     * Obtiene listado de departamentos y tipos de vehiculos, devuelve vista para buscar vehiculos
     * @return vista inicial de los filtros de busquedas para los VEHICULOS
     */
    public function buscarVehiculos()
    {
        $departamentos= Departamento::select('id','departamento')->get();
        $arrayDepartamento = array();
        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }
        $data["arrayDepartamento"]=$arrayDepartamento;

        $tipos= Tipo::select("id","tipo")->where("categoria","V")->get();
        $arrayCategorias = array();
        foreach ($tipos as $tipo){
            $arrayCategorias[$tipo->id]= $tipo->tipo;
        }
        $data["arrayCategorias"]=$arrayCategorias;

        return view('busquedas.Vehiculos.index', $data);
    }

    /**
     * Obtiene listado de vehiculos filtrandolos por criterios ingresados en vista de filtro de vehiculos
     * @return vista
     */
    public function getVehiculos(Request $request){
        $publicacion = new Publicacion();
        $vehiculos = $publicacion->filtroVehiculos("", $request->categorias, $request->marca, $request->modelo, $request->departamento, $request->municipio_id);
        dd($vehiculos);
    }


}
