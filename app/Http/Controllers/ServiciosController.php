<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Controlador
use App\Http\Controllers\UtilsController;

// Modelos
use App\Models\Servicio;


class ServiciosController extends Controller
{
    protected $Utils;

    public function __construct()
    {
        $this->Utils = (new UtilsController());
    }


    public function index()
    {
        $usuario = $this->Utils->SessionUser();
        $id_institucion = $usuario['id_institucion'];

        $servicios = Servicio::where('nr_institucion', $id_institucion)
                                ->where('tp_activo', 1)
                                ->with('Users')
                                ->with('unidad')
                                ->with('depto')
                                ->get();

        return['servicios' => $servicios];
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
