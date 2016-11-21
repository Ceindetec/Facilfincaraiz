<?php

namespace facilfincaraiz\Http\Controllers;

use facilfincaraiz\Galeria;
use facilfincaraiz\Inmueble;
use facilfincaraiz\Municipio;
use facilfincaraiz\Publicacion;
use facilfincaraiz\Vehiculo;
use Illuminate\Http\Request;
use facilfincaraiz\User;
use facilfincaraiz\Departamento;
use facilfincaraiz\Tipo;
use facilfincaraiz\MarcaDeAgua;
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
        $existe = User::where('email',$request->email)->first();
        if(!isset($existe)) {
            $user = new User($request->all());
            $user->password = bcrypt($request->password);
            $user->rol = "admin";
            $user->save();
            return "exito";
        }else{
            return "existe";
        }


    }



    /**
     * Devuelve vista de administracion de imagenes del banner
     *
     * @return \Illuminate\Http\Response
     */
    public function adminBanner()
    {
        $data['imageSlider'] = GaleriaPortada::where('tipo', 'S')->get();
        $data['imageInmuebles']= GaleriaPortada::where('tipo', 'I')->get();
        $data['imageTerrenos']= GaleriaPortada::where('tipo', 'T')->get();
        $data['imageVehiculos']= GaleriaPortada::where('tipo', 'V')->get();


       // dd($data);
        return view('Administrador/banner', $data);
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
            $this->scalarImgCategoria('images/admin/'.utf8_decode($nombre),$extension);
            return json_encode(array('ruta' => $nombre, 'id' => $galeria->id));
        }
        else
            return json_encode(array('error'=>'Archivo no permitido'));
    }


    /**
     * @param  string $ruta
     */
    private function scalarImgCategoria($ruta,$exten){

        if($exten=="jpg"||$exten=="jpeg"){
            $im = imagecreatefromjpeg($ruta);
            //Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
            $tmp=imagecreatetruecolor(500,306);
            //Ancho y alto de la imagen original
            list($ancho,$alto)=getimagesize($ruta);
            imagecopyresampled($tmp,$im,0,0,0,0,500, 306,$ancho,$alto);
            imagejpeg($tmp, $ruta,100);
            imagedestroy($im);
        }elseif ($exten=="png"){
            $im = imagecreatefrompng($ruta);
            //Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
            $tmp=imagecreatetruecolor(500,306);
            //Ancho y alto de la imagen original
            list($ancho,$alto)=getimagesize($ruta);
            imagecopyresampled($tmp,$im,0,0,0,0,500, 306,$ancho,$alto);
            imagepng($tmp, $ruta,100);
            imagedestroy($im);
        }
    }


    /**
     * Elimina una imagen de una publicacion.
     *
     * @param  Request $request
     * @return string
     */
    public function deleteImgPublic(Request $request)
    {
        $galeria = Galeria::find($request->id);
        $ruta= $galeria->ruta;
        $affectedRows = $galeria->delete();

        if ($affectedRows){
            unlink('images/publicaciones/'.utf8_decode($ruta));
            return "exito";
        }else{
            return "error";
        }
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
         $publicaciones = Publicacion::skip($request->start)->take($request->length)
            ->where("estado",$estado)
            ->where('titulo', 'like', "%".$request->search["value"]."%")
            ->orderBy($request->columns[$request->order[0]["column"]]["data"], $request->order[0]["dir"])
            ->get();

        foreach ($publicaciones as $publicacione){
            switch ($publicacione->tipo){
                case "I":$publicacione->tipo="Inmueble";
                    break;
                case "T":$publicacione->tipo="Terreno";
                    break;
                case "V":$publicacione->tipo="Vehículo";
                    break;
            }
            switch ($publicacione->accion){
                case "V":$publicacione->accion="Vender";
                    break;
                case "P":$publicacione->accion="Permutar";
                    break;
                case "A":$publicacione->accion="Arrendar";
                    break;
            }
        }

        $resultado["data"]= $publicaciones;
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

        //$this->insertarmarcadeagua($galerias,$publicacion->user_id);

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

        //$this->insertarmarcadeagua($galerias,$publicacion->user_id);

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

        //$this->insertarmarcadeagua($galerias,$publicacion->user_id);
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
        if($request->imagenes)
        foreach ($request->imagenes as $index => $imagene){

            $type=explode("/", $imagene->getMimeType());

            $archivo = $imagene->getClientOriginalName();
            $trozos = explode(".", $archivo);
            $extension = end($trozos);
            if($type[0]=="image"){
                $nombre = time().$index.".".strtolower($extension);
                $imagene->move('images/publicaciones', utf8_decode($nombre));

                $galeria = new Galeria();
                $galeria->publicacion_id=$publicacion->id;
                $galeria->ruta = $nombre;
                $galeria->mimeType=$type[1];
                $galeria->save();
            }

        }
        $galerias=$publicacion->getGaleria;
        $this->insertarmarcadeagua($galerias,$publicacion->user_id);
        return $publicacion;
    }


    function insertarmarcadeagua($galerias,$user_id){


        $marcaDA = MarcaDeAgua::where("user_id",$user_id)->first();

        foreach ($galerias as $galeria){
            // dd($galeria);
            //$this->insertarmarcadeagua('images/publicaciones/'.$galeria->ruta,'images/marcaAgua.png',10);
            // Cargar la estampa y la foto para aplicarle la marca de agua

            if($marcaDA==null)
                $estampa = imagecreatefrompng('images/logo.png');
            else
                $estampa = imagecreatefrompng('images/marcasDeAgua/'.$marcaDA->ruta);

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


    /**
     * @return string
     */
    public function marcaDeAgua(Request $request){

        $marcaDA = MarcaDeAgua::paginate(10);

        if($request->ajax()){
            return response()->json(view('Administrador.usuariosMarcaDA',compact("marcaDA"))->render());
        }

        return view('Administrador.marcaDeAgua',compact("marcaDA"));
    }
    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $arrayUsuarios
     */
    public function autoCompleUsuarios(Request $request)
    {
        $usuarios = User::where("email","like","%".$request->input("nombre")."%")->where('rol','usuario')->get();

        $arrayUsuarios = array();
        foreach ($usuarios as $usuario){
            $arrayUsuarios[]=$usuario->email;
        }
        return $arrayUsuarios;
    }

    /**
     * esta funcion se encarga de retornar la informacion de un usuario con su corespondiente marca de agua
     *
     * @param Request $request
     * @return string
     */
    public function infoUsuario(Request $request){

        $usuarios = User::select("id","nombres","apellidos","email","telefono")->where("email",$request->input("nombre"))->first();

        //dd($usuarios);

        if($usuarios!=null) {
            $data["nombres"] = $usuarios->nombres . " " . $usuarios->apellidos;
            $data["email"] = $usuarios->email;
            $data["telefono"] = $usuarios->telefono;
            if($usuarios->getMarcaDeAgua!=null){
                $marcaDA=$usuarios->getMarcaDeAgua;
                $data["ruta"] = $marcaDA->ruta;
                $data["id_ruta"] = $marcaDA->id;
            }else
                $data["ruta"]=null;
            $data["bandera"] = true;
        }else{
            $data["bandera"] = false;
        }

        return $data;

    }

    /**
     * @return string
     */
    public function eliminaMarcaDA(Request $request)
    {
        return $this->removeMarcaDA($request->id);
    }

    /**
     * @return string
     */
    private function removeMarcaDA($id){

        $marcaDA = MarcaDeAgua::find($id);
        $ruta= $marcaDA->ruta;
        $affectedRows = $marcaDA->delete();

        if ($affectedRows){
            unlink('images/marcasDeAgua/'.utf8_decode($ruta));
            return ["estado"=>true];
        }else{
            return ["estado"=>false];
        }
    }

    /**
     * @return string
     */
    public function subirMarcaDA(Request $request){

        $usuarios = User::select("id")->where("email",$request->input("email"))->first();

        if($request->imagenes)
            foreach ($request->imagenes as $index => $imagene){

                $type=explode("/", $imagene->getMimeType());

                $archivo = $imagene->getClientOriginalName();
                $trozos = explode(".", $archivo);
                $extension = end($trozos);
                if($type[0]=="image"){
                    $nombre = time().$index.".".strtolower($extension);
                    $imagene->move('images/marcasDeAgua', utf8_decode($nombre));

                    if($usuarios->getMarcaDeAgua==null){
                        $marcaDA = new MarcaDeAgua();
                        $marcaDA->user_id=$usuarios->id;
                    }else{
                        $marcaDA = MarcaDeAgua::where("user_id",$usuarios->id)->first();
                        unlink('images/marcasDeAgua/'.utf8_decode($marcaDA->ruta));
                    }
                        $marcaDA->ruta = $nombre;
                        $marcaDA->save();
                }

            }
            return ["estado"=>true];
    }




}
