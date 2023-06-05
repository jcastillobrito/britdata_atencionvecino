<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //obtener el atributo xx del usuario en sesion
        $user           = auth()->user();
        $nr_institucion = $user->nr_institucion;
        $cant           = $request->cant;
        $criterio       = $request->criterio;
        $busqueda       = $request->busqueda;
        $orderBy       = $request->orderBy;
        
        $users = User::select('password',
                            'nombres',
                            'ap_paterno',
                            'ap_materno',
                            'nr_rut',
                            'id_externo',
                            'email',
                            'celular',
                            'tp_activo',
                            'email',
                            'nr_institucion',
                            'id')
                        ->selectRaw('CONCAT(SUBSTRING(nombres, 1, 1),SUBSTRING(ap_paterno, 1, 1)) as letters')
                        ->selectRaw('DATE_FORMAT(last_login,"%d-%m-%Y %H:%i") as last_login')
                        ->where('nr_institucion','=',$nr_institucion)->with('roles')
                        ->orderBy($criterio,$orderBy);

        if($busqueda != '')
            $users = $users->where($criterio,'like','%'.$busqueda.'%');

        $users = $users->paginate($cant);

        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];


    }
}
