<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
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

        $roles = Role::select('name','id')->where('id','!=',1)->get();

        return [
            'unidades' => $unidades,
            'roles'    => $roles
        ];

        
    }
}
