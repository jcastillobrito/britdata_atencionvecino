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
        
        $users = User::where('nr_institucion','=',$nr_institucion)->get();
        return $users;
    }
}
