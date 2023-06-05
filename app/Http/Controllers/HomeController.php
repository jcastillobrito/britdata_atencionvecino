<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Institucion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user           = Auth()->user();
        $nombre         = $user->nombres.' '.$user->ap_paterno;
        $institucion    = $user->nr_institucion;

        $insitucion     = Institucion::where('id','=',$institucion)->first();
        $nm_institucion = $insitucion->nm_institucion;

        $role           = $user->getRoleNames()->first();

        $mensaje = "SISTEMA EN DESARROLLO";

        return view('home')
                ->with('nombre',$nombre)
                ->with('nm_institucion',$nm_institucion)
                ->with('role',$role)
                ->with('mensaje',$mensaje);
    }
}
