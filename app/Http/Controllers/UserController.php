<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

//Modelos
use App\Models\User;
use App\Models\Message;
use App\Models\Institucion;


use Spatie\Permission\Models\Role;
use Freshwork\ChileanBundle\Rut;


use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;

//Notificaciones
use App\Notifications\CreatePassword;
use App\Notifications\UpdatePassword;

use App\Http\Controllers\UtilsController;


class UserController extends Controller
{
    protected $Utils;

    public function __construct()
    {
        $this->Utils = (new UtilsController());
    }

    public function page()
    {
        $usuario = $this->Utils->SessionUser();

        return view('users.users')
                ->with('nombre'         ,$usuario['nombre'])
                ->with('nm_institucion' ,$usuario['nm_institucion'])
                ->with('role'           ,$usuario['role'])
                ->with('notifications'  ,$usuario['notifications'])
                ->with('mensaje'        ,$usuario['mensaje']);
    }

    public function store(UserCreateRequest $request)
    {
        $dataToUpdate   = $request->all();

        $id_institucion = auth()->user()->nr_institucion;

        $rol            = $request->input('nr_rol'); // Obtén el nuevo ID del rol desde la solicitud
        $rut            = Rut::parse($request->nr_rut)->format(Rut::FORMAT_WITH_DASH);

        $clave          = '123456';
        $password       = bcrypt($clave);
        // Crear los campos del usuario con los datos enviados en la solicitud
        $dataToUpdate['password']       = $password;
        $dataToUpdate['nr_institucion'] = $id_institucion;
        $dataToUpdate['nr_rut']         = $rut;


        try {
        
                $user = User::create($dataToUpdate);
                $user->syncRoles([$rol]); // Asignar el nuevo rol como el único rol del usuario

                $message = Message::create([
                    'sender_id'     =>  auth()->user()->id,
                    'recipient_id'  =>  $user->id,
                    'body'          =>  'Creación de Cuenta',
                ]);

                //Notificacion
                $user->notify(new CreatePassword($message));

                return ['error'=>0,'color'=>'success','msg'=>'Usuario creado correctamente'];

       } catch (\Throwable $th) 
       {
            dd($th);
          return ['error'=>1,'color'=>'error','msg'=>'Error al crear el usuario'];
       }
    }


    public function update(UserUpdateRequest $request)
    {
        $dataToUpdate   = $request->except(['id','nr_rol']);
        $id             = $request->input('id');


        $rut            = Rut::parse($request->nr_rut)->format(Rut::FORMAT_WITH_DASH);

        try {
        
                $user                   = User::findOrFail($id);
                $role                   = Role::findById($request->input('nr_rol')); // Obtén el nuevo ID del rol desde la solicitud
                $dataToUpdate['nr_rut'] = $rut;
                User::where('id', $id)->update($dataToUpdate);
                $user->syncRoles([$role]); // Asignar el nuevo rol como el único rol del usuario
                return ['error'=>0,'color'=>'success','msg'=>'Usuario actualizado correctamente'];

        } catch (\Throwable $th) 
        {
            return ['error'=>1,'color'=>'error','msg'=>'Error al actualizar el usuario'];
        }
        

    }

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
                            'nr_depto',
                            'nr_unidad',
                            'id')
                        ->selectRaw('CONCAT(SUBSTRING(nombres, 1, 1),SUBSTRING(ap_paterno, 1, 1)) as letters')
                        ->selectRaw('DATE_FORMAT(last_login,"%d-%m-%Y %H:%i") as last_login')
                        ->with('Unidad')
                        ->with('Depto')
                        ->where('nr_institucion','=',$nr_institucion)->with('roles');
                        //->orderBy($criterio,$orderBy);

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
