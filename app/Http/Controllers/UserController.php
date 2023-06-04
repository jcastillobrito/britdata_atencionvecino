<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        //obtener el atributo xx del usuario en sesion
        $user           = auth()->user();
        $nr_institucion = $user->nr_institucion;
        
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
                        ->where('nr_institucion','=',$nr_institucion)->with('roles')->paginate(15);

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
