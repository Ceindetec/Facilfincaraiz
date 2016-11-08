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
        $info = $this->obtenerInfoVistaVehiculos();
        $data["arrayDepartamento"] = $info["arrayDepartamento"];
        $data["arrayCategorias"] = $info["arrayCategorias"];

        return view('busquedas.Vehiculos.index', $data);
    }

    public function obtenerInfoVistaVehiculos(){
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
        return $data;
    }

    /**
     * Obtiene listado de vehiculos filtrandolos por criterios ingresados en vista de filtro de vehiculos
     * @return vista
     */
    public function getVehiculos(Request $request){
        $publicacion = new Publicacion();
        if ($request->ajax()) {
            $precio =  str_replace("$", '',str_replace(".", '', $request->precioMin)) . "-" . str_replace("$", '',str_replace(".", '', $request->precioMax));
            $consultas = $publicacion->filtrarVehiculos($request->categorias, $request->marca, $request->modelo, $request->departamento, $request->municipio_id, $request->pagina, $request->cilindraje, $precio);
            $data["cantidad"] = $consultas["cantidad"];
            $data["publicaciones"] = $consultas["resultados"];
            $data["mensaje"] = $consultas["mensaje"];
            $data["pagina"] = $request->pagina;
            return $data;
        }
        else {
            $consultas = $publicacion->filtrarVehiculos($request->categorias, $request->marca, $request->modelo, $request->departamento, $request->municipio_id, 1, "", "");
            $data["cantidad"] = $consultas["cantidad"];
            $data["publicaciones"] = $consultas["resultados"];
            $data["mensaje"] = $consultas["mensaje"];

            $data["categoria"] = $request->categorias;
            $data["marca"] = $request->marca;
            $data["modelo"] = $request->modelo;
            $data["departamento"] = $request->departamento;
            $data["municipio"] = $request->municipio_id;
            $infoAdicional = $this->obtenerInfoVistaVehiculos();
            $data["arrayDepartamento"] = $infoAdicional["arrayDepartamento"];
            $data["arrayCategorias"] = $infoAdicional["arrayCategorias"];
            return view('busquedas.Vehiculos.listado', $data);
        }
    }


}
