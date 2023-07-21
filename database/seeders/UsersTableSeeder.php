<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;
use Arr;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('model_has_roles')->truncate();

        $superadminRole     = Role::create(['name'  => 'SUPER-ADMIN',    'color' => '#374785']);
        $adminRole          = Role::create(['name'  => 'ADMIN',          'color' => '#60A561']);
        $jefeUnidadRole     = Role::create(['name'  => 'JEFE UNIDAD',    'color' => '#B5536C']);
        $jefeDeptoRole      = Role::create(['name'  => 'JEFE DEPTO',     'color' => '#E9A34B']);
        $seccionRol         = Role::create(['name'  => 'JEFE SECCION',   'color' => '#8C6F70']);
        $funcionarioRole    = Role::create(['name'  => 'COLABORADOR',    'color' => '#4D87A0']);
        $concejalesRole     = Role::create(['name'   => 'CONCEJAL',     'color' => '#C3A7D0']);

        $users =    User::factory(50)->create();

        $users->each(function ($user) 
        {
            $roleNames  = ['SUPER-ADMIN', 'ADMIN', 'JEFE UNIDAD', 'JEFE DEPTO', 'JEFE SECCION', 'COLABORADOR', 'CONCEJAL'];
            $role       = Arr::random($roleNames);
            $user->assignRole($role);
        });

        //SELECT * FROM `users` as u join model_has_roles as m on m.model_id=u.id and m.role_id=2;
         
    }
}