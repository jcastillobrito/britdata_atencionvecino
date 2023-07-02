<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Controlador
use App\Http\Controllers\UtilsController;


class ServiciosController extends Controller
{
    protected $Utils;

    public function __construct()
    {
        $this->Utils = (new UtilsController());
    }

    public function page()
    {
        $usuario        = $this->Utils->SessionUser();

        return view('servicios.servicios')
                ->with('nombre'         ,$usuario['nombre'])
                ->with('nm_institucion' ,$usuario['nm_institucion'])
                ->with('role'           ,$usuario['role'])
                ->with('notifications'  ,$usuario['notifications'])
                ->with('mensaje'        ,$usuario['mensaje']);
    }
}
