<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Institucion;


class UtilsController extends Controller
{
    function SessionUser()
    {
        $user           = Auth()->user();
        $nombre         = $user->nombres.' '.$user->ap_paterno;
        $institucion    = $user->nr_institucion;

        $ins_tmp        = Institucion::where('id','=',$institucion)->first();
        $nm_institucion = $ins_tmp->nm_institucion;

        $role           = $user->getRoleNames()->first();


        $mensaje        = "SISTEMA EN DESARROLLO";

        $notifications  = $user->notifications()->latest()->take(5)->get();

        return [
                'nombre'            => $nombre,
                'nm_institucion'    => $nm_institucion,
                'id_institucion'    => $institucion,
                'role'              => $role,
                'notifications'     => $notifications,
                'mensaje'           => $mensaje
            ];
    }
}
