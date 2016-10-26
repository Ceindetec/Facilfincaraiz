<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;
use facilfincaraiz\User;
use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\GaleriaPortada;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * esta funcion es la encargada de lanzar la vista para crear el registro de nuevos administradores
     *
     * @return view
     */
    public function registroAdmins(){
        return view('superAdmin.registroAdmins');

    }


    /**
     * esta vista es la encargada de realizar el resgitro en base de datos de los administradores
     * @param $request
     * @return array
     */
    public function registroAdminsPost(Request $request){

        $user = new User($request->all());
        $user->password= bcrypt($request->password);
        $user->rol="admin";
        $user->save();
        return "exito";


    }



    /**
     * Devuelve vista de administracion de imagenes del banner
     *
     * @return \Illuminate\Http\Response
     */
    public function adminBanner()
    {
        $imageSlider = GaleriaPortada::where('tipo', 'S')->get();
        return view('Administrador/banner', compact('imageSlider'));
    }

    /**
     * Elimina la imagen especificada de la tabla GaleriaPortada.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteImgBanner(Request $request)
    {
        $affectedRows = GaleriaPortada::where('id', $request->id)->delete();
        if ($affectedRows > 0){
            unlink('images/admin/'.utf8_decode($request->ruta));
            return "exito";
        }else{
            return "error";
        }
    }

    /**
     * Carga las imagenes correspondientes para el administrador.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function subirImagen(Request $request)
    {
//        dd($request->all());
        $fotos = $request->file('inputGalery');

        if ($fotos != null) {
            $fotos = $fotos[0];

            $extension = explode(".", $fotos->getClientOriginalName());
            $cantidad = count($extension) - 1;
            $extension = $extension[$cantidad];
            $nombre = time(). $request->file_id. "." . $extension;

            $fotos->move('images/admin', utf8_decode($nombre));

            $galeria = new GaleriaPortada();
            $galeria->ruta = $nombre;
            $galeria->tipo = $request->tipo;
            $galeria->save();

            return json_encode(array('ruta' => $nombre, 'id' => $galeria->id));
        }
        else
            return json_encode(array('error'=>'Archivo no permitido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @return string
     */
    public function publicPendientes()
    {
        return view('Administrador.publicPendientes');
    }


    /**
     * @return string
     */
    public function pendientes(Request $request)
    {

        dd($request->all());


        $data = array();

        $data["draw"]=$request->draw;
        $data["recordsTotal"]=57;
        $data["recordsFiltered"]=57;
        $data["data"]=[
            [
                "Airi",
                "Satou",
                "Accountant",
                "Tokyo",
                "28th Nov 08",
                "$162,700"
            ],
            [
                "Angelica",
                "Ramos",
                "Chief Executive Officer (CEO)",
                "London",
                "9th Oct 09",
                "$1,200,000"
            ],
            [
                "Ashton",
                "Cox",
                "Junior Technical Author",
                "San Francisco",
                "12th Jan 09",
                "$86,000"
            ],
            [
                "Bradley",
                "Greer",
                "Software Engineer",
                "London",
                "13th Oct 12",
                "$132,000"
            ],
            [
                "Brenden",
                "Wagner",
                "Software Engineer",
                "San Francisco",
                "7th Jun 11",
                "$206,850"
            ],
            [
                "Brielle",
                "Williamson",
                "Integration Specialist",
                "New York",
                "2nd Dec 12",
                "$372,000"
            ],
            [
                "Bruno",
                "Nash",
                "Software Engineer",
                "London",
                "3rd May 11",
                "$163,500"
            ],
            [
                "Caesar",
                "Vance",
                "Pre-Sales Support",
                "New York",
                "12th Dec 11",
                "$106,450"
            ],
            [
                "Cara",
                "Stevens",
                "Sales Assistant",
                "New York",
                "6th Dec 11",
                "$145,600"
            ],
            [
                "Cedric",
                "Kelly",
                "Senior Javascript Developer",
                "Edinburgh",
                "29th Mar 12",
                "$433,060"
            ],
            [
                "Airi",
                "Satou",
                "Accountant",
                "Tokyo",
                "28th Nov 08",
                "$162,700"
            ],
            [
                "Angelica",
                "Ramos",
                "Chief Executive Officer (CEO)",
                "London",
                "9th Oct 09",
                "$1,200,000"
            ],
            [
                "Ashton",
                "Cox",
                "Junior Technical Author",
                "San Francisco",
                "12th Jan 09",
                "$86,000"
            ],
            [
                "Bradley",
                "Greer",
                "Software Engineer",
                "London",
                "13th Oct 12",
                "$132,000"
            ],
            [
                "Brenden",
                "Wagner",
                "Software Engineer",
                "San Francisco",
                "7th Jun 11",
                "$206,850"
            ],
            [
                "Brielle",
                "Williamson",
                "Integration Specialist",
                "New York",
                "2nd Dec 12",
                "$372,000"
            ],
            [
                "Bruno",
                "Nash",
                "Software Engineer",
                "London",
                "3rd May 11",
                "$163,500"
            ],
            [
                "Caesar",
                "Vance",
                "Pre-Sales Support",
                "New York",
                "12th Dec 11",
                "$106,450"
            ],
            [
                "Cara",
                "Stevens",
                "Sales Assistant",
                "New York",
                "6th Dec 11",
                "$145,600"
            ],
            [
                "Cedric",
                "Kelly",
                "Senior Javascript Developer",
                "Edinburgh",
                "29th Mar 12",
                "$433,060"
            ]
        ];

        return $data ;
    }



}
