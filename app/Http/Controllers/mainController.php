<?php

namespace facilfincaraiz\Http\Controllers;

use Illuminate\Http\Request;

use facilfincaraiz\Http\Requests;
use facilfincaraiz\Http\Controllers\Controller;

class mainController extends Controller
{
    public function contacto()
    {
        return view("contacto");
    }
}
