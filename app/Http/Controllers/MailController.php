<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;

class MailController extends Controller
{
    /**
     * @return string
     */
    public function enviar(Request $request){
        global  $email;
        $email = $request->email;
        Mail::send("emails.contacto",$request->all(),function ($msj){
            global  $email;
            $msj->subject("Contacto");
            $msj->to("ventas@facilfincaraiz.com");
            $msj->replyTo($email, $name = null);
        });
        //Session::flash('message','Mensaje fue enviado correctamente');
        return "exito";
    }


    /**
     * @return string
     */
    public static function sePublico($request){

        global  $email;
        $email = $request["email"];
        Mail::send("emails.publicaciones",$request,function ($msj){
            global  $email;
            $msj->subject("Publicaciones");
            $msj->to("ventas@facilfincaraiz.com");
            $msj->replyTo($email, $name = null);
        });
        return "exito";
    }


    /**
     * @return string
     */
    public function interesXpublicacion(Request $request){
        global  $email;
        $email = $request->email;
        Mail::send("emails.interesXpublicacion",$request->all(),function ($msj){
            global  $email;
            $msj->subject("Interes por una publicación");
            $msj->to("ventas@facilfincaraiz.com");
            $msj->replyTo($email, $name = null);
        });
        //Session::flash('message','Mensaje fue enviado correctamente');
        return "exito";
    }


}
