<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

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
        $imageSlider = GaleriaPortada::where('tipo', 'S')->get();
        return view('welcome', compact('imageSlider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
