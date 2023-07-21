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

    public function service_users_edit(Request $request)
    {
        $tp_status  = $request->tp_status;
        $id_user    = $request->id_user;
        $old_status = $request->old_status;
        $tp_status  = $request->tp_status;
        $id_service = $request->id_service;

        $msg        = 'Usuario editado correctamente';
        $color      = 'success';
        

        $array_status     = [
                                'tp_activo',
                                'tp_respuesta_final',
                                'tp_derivacion',
                                'tp_responsable',
                            ];

        $new_value = $old_status  ? 0 : 1;

        if($array_status[$tp_status] == 'tp_activo' && $new_value == 0)
        {
            $contar_users = ServiceUser::where('id_service','=',$id_service)->where('tp_activo','=',1)->count();

            if($contar_users == 1)
                {
                    $msg    = 'Usuario eliminado correctamente,el servicio dejará de ser visible al público';
                    $color  = 'warning';
                    Servicio::where('id','=',$id_service)->update(['tp_visible' => 0]);
                }

        }
        

        if($array_status[$tp_status] == 'tp_responsable' && $new_value == 0)
        {
            $contar_users = ServiceUser::where('id_service','=',$id_service)->where('tp_responsable','=',1)->count();

            if($contar_users == 1)
                return['msg' => 'El servicio debe tener al menos un responsable','color'=>'warning'];
        }

        if($array_status[$tp_status] == 'tp_respuesta_final' && $new_value == 0)
        {
            $contar_users = ServiceUser::where('id_service','=',$id_service)->where('tp_respuesta_final','=',1)->count();
            
            if($contar_users == 1)
                return['msg' => 'El servicio debe tener al menos una persona que responda al vecino','color'=>'warning'];
        }
        
        ServiceUser::where('id_service','=',$id_service)->where('id_user','=',$id_user)->update([$array_status[$tp_status] => $new_value]);

        return['msg' => $msg,'color'=>$color];

    }

    public function service_users_store(Request $request)
    {
        $id_user    = $request->id_user;
        $id_service = $request->id_service;

        $cantidad   = ServiceUser::where('id_service', $id_service)->count();

        $valida     = ServiceUser::where('id_user', $id_user)
                                ->where('id_service', $id_service)
                                ->where('tp_activo', 1)
                                ->count();

        if($valida)
            return['msg' => 'El usuario ya se encuentra en el servicio','color'=>'error'];


        ServiceUser::where('id_user', $id_user)
            ->where('id_service', $id_service)
            ->where('tp_activo', 0)
            ->delete();


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
        $id_institucion = $this->Utils->SessionUser()['id_institucion'];
        $nr_unidad      = $request->nr_unidad;


        $participantes = User::select('users.id as value', 'users.id', 'users.nr_unidad','users.nr_depto')
                        ->selectRaw('CONCAT(nombres, " ", ap_paterno, " ", " - ", depto.nombre) as label')
                        ->join('depto', 'users.nr_depto', '=', 'depto.id') // Agregar un join con la tabla "unidad"
                        ->where('users.nr_institucion', $id_institucion)
                        ->where('users.tp_activo', 1)
                        ->where('users.nr_unidad', $nr_unidad)
                        ->whereNotIn('users.id', $lista_users)
                        ->whereHas('roles', function ($query) 
                        {
                            $query->where('name', '=', 'ADMIN')
                                ->orWhere('name', '=', 'JEFE UNIDAD')
                                ->orWhere('name', '=', 'JEFE DEPTO')
                                ->orWhere('name', '=', 'JEFE SECCION')
                                ->orWhere('name', '=', 'COLABORADOR');
                        })->get();


        return['participantes' => $participantes];

    }

    public function index(Request $request)
    {
        $id_servicio    = $request->id_servicio;
        $usuario        = $this->Utils->SessionUser();
        $id_institucion = $usuario['id_institucion'];

        $servicios_all = Servicio::where('nr_institucion', $id_institucion)
                                ->where('tp_activo', 1)
                                ->withCount('usuarios')
                                ->with('unidad')
                                ->with('depto');

        if($id_servicio)
            return ['servicios' => $servicios_all->where('id', $id_servicio)->with('usuarios.users.depto')->first()];

        return['servicios' => $servicios_all->get()];
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
