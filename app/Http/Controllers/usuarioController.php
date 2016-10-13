<?php

namespace facilfincaraiz\Http\Controllers;

use facilfincaraiz\User;
use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;

class usuarioController extends Controller
{

    public function registroUser()
    {
        return view("auth.registroUser");
    }


    public function registroUserPost(Request $request)
    {
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




}
