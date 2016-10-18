<?php

namespace facilfincaraiz\Http\Controllers;

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
                return view("usuario.publicarTerreno");
            }else{
                return view("usuario.publicarVehiculo");
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
}
