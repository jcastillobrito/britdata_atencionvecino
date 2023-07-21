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
        //Auth::logout();             
        //return redirect()->back();

       
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
                Auth::logout();             
                return redirect()->back();
            break;
        }

        $destino ='users.page';

        return redirect()->route($destino);
        
    }
}
