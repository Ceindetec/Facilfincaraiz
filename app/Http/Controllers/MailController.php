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
    public function enviar(Request $request)
    {
        global  $email;
        $email = $request->email;
        Mail::send("emails.contacto",$request->all(),function ($msj){
            global  $email;
            $msj->subject("contacto enFutbol");
            $msj->to("informacion.enfutbol.co@gmail.com");
            $msj->replyTo($email, $name = null);

        });
        //Session::flash('message','Mensaje fue enviado correctamente');
        return "exito";
    }
}
