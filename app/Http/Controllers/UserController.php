<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use Spatie\Permission\Models\Role;


use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    public function update(UserCreateRequest $request)
    {
        $dataToUpdate   = $request->except(['id','nr_rol']);
        $id             = $request->input('id');

        $user           = User::findOrFail($id);

        $role           = Role::findById($request->input('nr_rol')); // Obtén el nuevo ID del rol desde la solicitud

        // Actualizar los campos del usuario con los datos enviados en la solicitud
        User::where('id', $id)->update($dataToUpdate);
        $user->syncRoles([$role]); // Asignar el nuevo rol como el único rol del usuario

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
