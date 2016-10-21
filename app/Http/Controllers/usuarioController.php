<?php

namespace facilfincaraiz\Http\Controllers;

use facilfincaraiz\Marca;
use facilfincaraiz\Tipo;
use facilfincaraiz\User;
use Illuminate\Http\Request;
use facilfincaraiz\Departamento;
use facilfincaraiz\Municipio;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;

class usuarioController extends Controller
{

    public function registroUser()
    {
        return view("auth.registroUser");
    }


    public function registroUserPost(Request $request){
        if($request->password==$request->cpassword){
            $user = new User($request->all());
            $user->password= bcrypt($request->password);
            $user->rol="usuario";
            $user->save();
            return "exito";
        }else{
            return "noson iguales";
        }
    }


    public function publicar()
    {
        return view("usuario.publicar");
    }

    public function publicarXCategoria($categoria)
    {
        $departamentos= Departamento::select('id','departamento')->get();

        $arrayDepartamento = array();

        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }

        $data["arrayDepartamento"]=$arrayDepartamento;

        if($categoria=="Inmuebles"||$categoria=="Terrenos"||$categoria=="Vehiculos"){
            if($categoria=="Inmuebles"){
                $tipos= Tipo::select("id","tipo")->where("categoria","I")->get();
                $arrayCategorias = array();
                foreach ($tipos as $tipo){
                    $arrayCategorias[$tipo->id]= $tipo->tipo;
                }
                $data["arrayCategorias"]=$arrayCategorias;
                return view("usuario.publicarInmueble",$data);

            }elseif($categoria=="Terrenos"){
                $tipos= Tipo::select("id","tipo")->where("categoria","T")->get();
                $arrayCategorias = array();
                foreach ($tipos as $tipo){
                    $arrayCategorias[$tipo->id]= $tipo->tipo;
                }
                $data["arrayCategorias"]=$arrayCategorias;
                return view("usuario.publicarTerreno",$data);
            }else{
                $tipos= Tipo::select("id","tipo")->where("categoria","V")->get();
                $arrayCategorias = array();
                foreach ($tipos as $tipo){
                    $arrayCategorias[$tipo->id]= $tipo->tipo;
                }
                $data["arrayCategorias"]=$arrayCategorias;
                return view("usuario.publicarVehiculo",$data);
            }
        }else{
            return redirect()->back();
        }



    }

    public function getMunicipios(Request $request){
        $municipios = Municipio::select('id', 'municipio')->where('id_dpto', $request->input('id'))->get();
        $arrayMunicipio = array();

        foreach ($municipios as $municipio) {
            $arrayMunicipio[$municipio->id] = $municipio->municipio;
        }
        //dd($arrayMunicipio);

        return $arrayMunicipio;
    }

    /**
     * esta función está encargada de retornar las marcas de un tipo y las combinadas con el tipo seleccionado
     * @param Request $request
     * @return array
     */
    public function getMarcas(Request $request){
        $marcas = Marca::select('id', 'marca')->whereIn('tipo', [$request->input('tipo'),'MC'])->get();
        $arrayMarcas = array();
        foreach ($marcas as $marca) {
            $arrayMarcas[$marca->id] = $marca->marca;
        }
        return $arrayMarcas;
    }

    /**
     * esta función está encargada de almacenar los datos que vienen de la vista en la base de datos
     * @param Request $request
     * @return array
     */
    public function publicarInmueble(Request $request){

        return $request->all();
    }

    /**
     * esta función está encargada de almacenar los datos que vienen de la vista en la base de datos
     * @param Request $request
     * @return array
     */
    public function publicarVehiculo(Request $request){

        return $request->all();
    }

}
