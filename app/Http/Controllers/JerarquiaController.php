<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unidad;
use App\Models\Depto;
USE App\Models\Seccion;

class JerarquiaController extends Controller
{
    public function init()
    {
        $user           = Auth()->user();
        $nr_institucion = $user->nr_institucion;

        $unidades       = Unidad::select('id','nombre')
                                    ->with('deptos')
                                    ->with('deptos.secciones')
                                    ->where('tp_activo','=','1')
                                    ->where('nr_institucion','=',$nr_institucion)
                                    ->get();

        return [
            'unidades' => $unidades
        ];

        
    }
}
