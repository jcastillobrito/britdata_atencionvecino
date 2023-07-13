<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\UtilsController;


class HomeController extends Controller
{
    protected $Utils;
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->Utils = new UtilsController;
    }


    public function index()
    {
        $role       = Auth::user()->getRoleNames()->first();
        switch($role)
        {
            case 'SUPER-ADMIN':
                $destino = 'home';
            break;

            case 'ADMIN':
                $destino = 'users.page';
            break;

            case 'JEFE UNIDAD':
                return 'pendiente';
            break;


            default:
               
            break;
        }

        return redirect()->route($destino);
        
    }
}
