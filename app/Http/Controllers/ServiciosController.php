<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Controlador
use App\Http\Controllers\UtilsController;

// Modelos
use App\Models\Servicio;
use App\Models\User;
use App\Models\ServiceUser;



class ServiciosController extends Controller
{
    protected $Utils;

    public function __construct()
    {
        $this->Utils = (new UtilsController());
        
    }

    public function service_users_store(Request $request)
    {
        $id_user    = $request->id_user;
        $id_service = $request->id_service;


        $cantidad = ServiceUser::where('id_service', $id_service)->count();

        $valida = ServiceUser::where('id_user', $id_user)
                                ->where('id_service', $id_service)
                                ->count();


        if($valida)
            return['msg' => 'El usuario ya se encuentra en el servicio','color'=>'error'];


        if($cantidad ==  0)
        $tmp_user = [
            'tp_respuesta_final'    =>  1,
            'tp_derivacion'         =>  1,
            'tp_responsable'        =>  1,
            'id_user'               => $id_user,
            'id_service'            => $id_service
        ];

        if($cantidad > 0)
        $tmp_user = [
            'tp_respuesta_final'    =>  0,
            'tp_derivacion'         =>  0,
            'tp_responsable'        =>  0,
            'id_user'               => $id_user,
            'id_service'            => $id_service
        ];



        ServiceUser::create($tmp_user);


        return ['msg' => 'Usuario agregado al servicio exitosamente','color'=>'success'];


    }

    public function service_users(Request $request)
    {
        $lista_users    = $request->lista_users;
        $texto          = $request->texto;
        $id_institucion = $this->Utils->SessionUser()['id_institucion'];


        //concatena nombres ap_paterno y ap_materno en un select orm de laravel


        $participantes = User::select('id as value')->selectRaw('CONCAT(nombres," ",ap_paterno," ",ap_materno) as label')
                        
                        ->where('nr_institucion', $id_institucion)
                        ->where('tp_activo', 1)
                        ->whereNotIn('id', $lista_users)
                        // usando spatie como filtro quienes tengan cierto roles
                        ->whereHas('roles', function ($query) {
                            $query->where('name', '=', 'ADMIN')
                                    ->orWhere('name', '=', 'JEFE UNIDAD')
                                    ->orWhere('name', '=', 'JEFE DEPTO')
                                    ->orWhere('name', '=', 'JEFE SECCION')
                                    ->orWhere('name', '=', 'COLABORADOR');
                        })
                        ->where(function ($query) use ($texto) {
                            $query->orWhere('ap_paterno', 'LIKE', '%' . $texto . '%')
                                    ->orWhere('ap_materno', 'LIKE', '%' . $texto . '%')
                                    ->orWhere('nombres', 'LIKE', '%' . $texto . '%');
                        })
                        ->get();

        return['participantes' => $participantes];

    }

    public function index()
    {
        $usuario = $this->Utils->SessionUser();
        $id_institucion = $usuario['id_institucion'];

        $servicios = Servicio::where('nr_institucion', $id_institucion)
                                ->where('tp_activo', 1)
                                ->with('usuarios.users')
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
