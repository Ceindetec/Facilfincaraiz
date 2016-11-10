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
     * Obtiene listado de departamentos y tipos de vehiculos, devuelve vista para buscar vehiculos
     * @return vista inicial de los filtros de busquedas para los VEHICULOS
     */
    public function buscarVehiculos()
    {
        $data["arrayDepartamento"] = $this->listarDepartamentos();
        $data["arrayCategorias"] = $this->listarTiposCategoria('V');
        return view('busquedas.Vehiculos.index', $data);
    }

    /**
     * Obtiene listado de vehiculos filtrandolos por criterios ingresados en vista de filtro de vehiculos
     * @return vista con listado de vehiculos o solo listado (data)
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
            $data["arrayDepartamento"] = $this->listarDepartamentos();
            $data["arrayCategorias"] = $this->listarTiposCategoria('V');
            return view('busquedas.Vehiculos.listado', $data);
        }
    }


    /////////////////////////////////////////////////////////////////////////////////
    ///////////////////////// BUSQUEDA DE INMUEBLES /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    /** Obtiene listado de departamentos y categorias, devuelve vista para busqueda de inmuebles
     * @return vista inicial de los filtros de busquedas para los INMUEBLES
     */
    public function buscarinmuebles()
    {
        $data["arrayDepartamento"] = $this->listarDepartamentos();
        $data["arrayCategorias"] = $this->listarTiposCategoria('I');
        return view("busquedas.Inmuebles.index", $data);
    }


    /////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////// OTRAS FUNCIONES ///////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////
    /**
     * Obtiene publicacion solicitado por id
     * @param $id int id correspondiente a la publicacion a detallar
     * @return vista respectiva (vehiculo, terreno o inmueble) con descripcion completa de la publicacion
     */
    public function getPublicacion($id){
        $publicacion = Publicacion::find($id);
        if ($publicacion != null){
            $publicacion->galeria;
            $publicacion->municipio = $publicacion->getMunicipio;
            $publicacion->departamento = $publicacion->municipio->getDepartamento->departamento;

            if($publicacion->tipo == "V"){
                $publicacion->vehiculo = $publicacion->getVehiculo;
                $publicacion->vehiculo->tipo = $publicacion->vehiculo->getTipo->tipo;
                $publicacion->vehiculo->marca = $publicacion->vehiculo->getMarca->marca;
                $data['publicacion'] = $publicacion;
                return view('busquedas.Vehiculos.detalleVehiculo', $data);
            }
            elseif($publicacion->tipo == "I"){

            }
            else{

            }
//            dd($publicacion);

        }
        else
            return redirect()->back();

    }

    /**
     * Obtiene listado de tipos de Categoria solicitada (Vehiculo, Inmueble, Terreno)
     * @param $categoria string sigla de categoria solicitada (I,V,T)
     * @return array con tipos de vehiculo
     */
    public function listarTiposCategoria($categoria){
        $tipos= Tipo::select("id","tipo")->where("categoria",$categoria)->get();
        $arrayCategorias = array();
        foreach ($tipos as $tipo){
            $arrayCategorias[$tipo->id]= $tipo->tipo;
        }
        return $arrayCategorias;
    }

    /**
     * Obtiene listado de departamentos
     * @return array con departamentos
     */
    public function listarDepartamentos(){
        $departamentos= Departamento::select('id','departamento')->get();
        $arrayDepartamento = array();
        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }
        return $arrayDepartamento;
    }


}
