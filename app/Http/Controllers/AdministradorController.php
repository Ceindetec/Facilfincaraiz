<?php

namespace facilfincaraiz\Http\Controllers;

use facilfincaraiz\Inmueble;
use facilfincaraiz\Municipio;
use facilfincaraiz\Publicacion;
use facilfincaraiz\Vehiculo;
use Illuminate\Http\Request;
use facilfincaraiz\User;
use facilfincaraiz\Departamento;
use facilfincaraiz\Tipo;
use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;
use facilfincaraiz\GaleriaPortada;
use Carbon\Carbon;

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
    public function publicAprobadas()
    {
        return view('Administrador.publicAprobadas');
    }

    /**
     * @return string
     */
    public function publicInactivas()
    {
        return view('Administrador.publicInactivas');
    }



    /**
     * @return string
     */
    public function pendientes(Request $request){

        return $this->llenarDataTable($request,"P");

    }
    /**
     * @return string
     */
    public function aprobadas(Request $request){

        return $this->llenarDataTable($request,"A");

    }
    /**
     * @return string
     */
    public function inactivas(Request $request){

        return $this->llenarDataTable($request,"I");

    }
    /**
     * @return string
     */
    public function llenarDataTable($request,$estado){

        $resultado["draw"] = isset($request->draw)? intval($request->draw): 0;

        $resultado["star"]=$request->start;
        $resultado["data"] = Publicacion::skip($request->start)->take($request->length)
            ->where("estado",$estado)
            ->where('titulo', 'like', "%".$request->search["value"]."%")
            ->orderBy($request->columns[$request->order[0]["column"]]["data"], $request->order[0]["dir"])
            ->get();

        $resultado["recordsTotal"]= count(Publicacion::where("estado",$estado)->get());

        $resultado["recordsFiltered"]= count(Publicacion::where("estado",$estado)->where('titulo', 'like', "%".$request->search["value"]."%")->get());

        return $resultado;
    }


    /**
     * @return string
     */
    public function validarPublicVehiculo($id){
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


        $publicacion= Publicacion::find($id);

        $vehiculo = Vehiculo::find($publicacion->articulo_id);

        $departamento = Municipio::select("id_dpto")->where("id",$publicacion->municipio_id)->first();

        $publicYvehiculo= array_merge($vehiculo->toArray(),$departamento->toArray(),$publicacion->toArray());
        $data["data"]=$publicYvehiculo;

        $galerias=$publicacion->getGaleria;
        $data["imagenes"]=$galerias;
        $data["user"]=$publicacion->getUsuario()->select('id', "nombres", "apellidos","email","telefono")->get()[0];

        $this->insertarmarcadeagua($galerias);

        //dd($data);
        return view('Administrador.validarPublicVehiculo',$data);
    }

    /**
     * @return string
     */
    public function validarPublicInmueble($id){
        $departamentos= Departamento::select('id','departamento')->get();
        $arrayDepartamento = array();
        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }
        $data["arrayDepartamento"]=$arrayDepartamento;

        $tipos= Tipo::select("id","tipo")->where("categoria","I")->get();
        $arrayCategorias = array();
        foreach ($tipos as $tipo){
            $arrayCategorias[$tipo->id]= $tipo->tipo;
        }
        $data["arrayCategorias"]=$arrayCategorias;



        $publicacion= Publicacion::find($id);

        $inmueble = Inmueble::find($publicacion->articulo_id);

        $departamento = Municipio::select("id_dpto")->where("id",$publicacion->municipio_id)->first();

        $publicYvehiculo= array_merge($inmueble->toArray(),$departamento->toArray(),$publicacion->toArray());
        $data["data"]=$publicYvehiculo;

        $galerias=$publicacion->getGaleria;
        $data["imagenes"]=$galerias;
        $data["user"]=$publicacion->getUsuario()->select('id', "nombres", "apellidos","email","telefono")->get()[0];

        $this->insertarmarcadeagua($galerias);

        //dd($data);

        return view('Administrador.validarPublicInmueble',$data);
    }

    /**
     * @return string
     */
    public function validarPublicTerreno($id)
    {
        $departamentos= Departamento::select('id','departamento')->get();
        $arrayDepartamento = array();
        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }
        $data["arrayDepartamento"]=$arrayDepartamento;

        $tipos= Tipo::select("id","tipo")->where("categoria","T")->get();
        $arrayCategorias = array();
        foreach ($tipos as $tipo){
            $arrayCategorias[$tipo->id]= $tipo->tipo;
        }
        $data["arrayCategorias"]=$arrayCategorias;

        $publicacion= Publicacion::find($id);

        $inmueble = Inmueble::find($publicacion->articulo_id);

        $departamento = Municipio::select("id_dpto")->where("id",$publicacion->municipio_id)->first();

        $publicYvehiculo= array_merge($inmueble->toArray(),$departamento->toArray(),$publicacion->toArray());
        $data["data"]=$publicYvehiculo;

        $galerias=$publicacion->getGaleria;
        $data["imagenes"]=$galerias;
        $data["user"]=$publicacion->getUsuario()->select('id', "nombres", "apellidos","email","telefono")->get()[0];

        $this->insertarmarcadeagua($galerias);
        return view('Administrador.validarPublicTerreno',$data);
    }

    /**
     * @return string
     */
    public function subirPublic(Request $request){

        //dd($request->all());

        $date = Carbon::now();

        $publicacion = Publicacion::find($request->id);

        $publicacion->update($request->all());
        $publicacion->fecha=$date->format('Y-m-d');

        $publicacion->save();


        $tipo = Tipo::find($request->tipo_id);
        $string="";
        if($request->adicinales)
            foreach ($request->adicinales as $adicial){
                $string=$string.$adicial.",";
            }
        if ($tipo->categoria=="V"){
            $vehiculo = Vehiculo::find($publicacion->articulo_id);
            $vehiculo->adicionales=trim($string, ',');
            $vehiculo->save();
        }else{
            $inmueble = Inmueble::find($publicacion->articulo_id);
            $inmueble->adicionales=trim($string, ',');
            $inmueble->save();
        }


        return $publicacion;
    }

    /**
     * @return string
     */
    public function subirPublicInmueble(Request $request)
    {
        return $request->all();
    }

    /**
     * @return string
     */
    public function subirPublicTerreno(Request $request)
    {
        return $request->all();
    }

    function insertarmarcadeagua($galerias){

        foreach ($galerias as $galeria){
            // dd($galeria);
            //$this->insertarmarcadeagua('images/publicaciones/'.$galeria->ruta,'images/marcaAgua.png',10);
            // Cargar la estampa y la foto para aplicarle la marca de agua
            $estampa = imagecreatefrompng('images/marcaAgua.png');

            // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
            $margen_dcho = 10;
            $margen_inf = 10;
            $sx = imagesx($estampa);
            $sy = imagesy($estampa);

            if($galeria->mimeType=="png"){
                $im = imagecreatefrompng('images/publicaciones/'.$galeria->ruta);

                if(imagesx($im)<$sx)
                    imagecopyresampled ( $im , $estampa , imagesx($im) - ($sx/2) - $margen_dcho , imagesy($im) - ($sy/2) - $margen_inf , 0 , 0 , ($sx/2), ($sy/2) , $sx , $sy );
                    /*imagecopy($im, $estampa, imagesx($im) - ($sx/2) - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, ($sx/2), ($sy/2));*/
                else
                    imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));
                imagepng($im, 'images/publicaciones/'.$galeria->ruta);
            }elseif($galeria->mimeType=="jpeg"){
                $im = imagecreatefromjpeg('images/publicaciones/'.$galeria->ruta);
                if(imagesx($im)<$sx)
                    imagecopyresampled ( $im , $estampa , imagesx($im) - ($sx/2) - $margen_dcho , imagesy($im) - ($sy/2) - $margen_inf , 0 , 0 ,($sx/2), ($sy/2) , $sx , $sy );
//                    imagecopy($im, $estampa, imagesx($im) - ($sx/2) - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, ($sx/2), ($sy/2));
                else
                    imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));
                imagejpeg($im, 'images/publicaciones/'.$galeria->ruta);
            }elseif($galeria->mimeType=="gif"){
                continue;
            }else{
                continue;
            }
            imagedestroy($im);

        }
    }


}
