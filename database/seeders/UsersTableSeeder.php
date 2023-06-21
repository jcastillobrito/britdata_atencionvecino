<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $superadminRole     = Role::create(['name'  => 'SUPER-ADMIN',    'color' => '#374785']);
        $adminRole          = Role::create(['name'  => 'ADMIN',          'color' => '#60A561']);
        $jefeUnidadRole     = Role::create(['name'  => 'JEFE UNIDAD',    'color' => '#B5536C']);
        $jefeDeptoRole      = Role::create(['name'  => 'JEFE DEPTO',     'color' => '#E9A34B']);
        $seccionRol         = Role::create(['name'  => 'JEFE SECCION',   'color' => '#8C6F70']);
        $funcionarioRole    = Role::create(['name'  => 'COLABORADOR',    'color' => '#4D87A0']);
        $concejalesRole     = Role::create(['name'   => 'CONCEJAL',     'color' => '#C3A7D0']);


        // Crear usuarios y asignar roles

        User::create([
            'nombres'           => 'Super ',
            'ap_paterno'        => 'Admin',
            'ap_materno'        => 'Admin',
            'nr_rut'            => '11111111-1',
            'id_externo'        => '4578',
            'email'             => 'supeadmin@gmail.com',
            'celular'           => '+56945897483',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'nr_institucion'    => 1,
        ])->assignRole($superadminRole);

        User::create([
            'nombres' => 'Juan Carlos',
            'ap_paterno' => 'Castillo',
            'ap_materno' => 'brito',
            'nr_rut' => '18241152-3',
            'id_externo' => '4578',
            'email' => 'jccastillo.brito@gmail.com',
            'celular' => '+56945897482',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'nr_institucion' => 1,
        ])->assignRole($adminRole);

        User::create([
            'nombres' => 'Francisca Salome',
            'ap_paterno' => 'Herrera',
            'ap_materno' => 'Contreras',
            'nr_rut' => '19577035-2',
            'id_externo' => '458',
            'email' => 'francisca@gmail.com',
            'celular' => '222222222',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'nr_institucion' => 1,
        ])->assignRole($jefeUnidadRole);

        User::create([
            'nombres' => 'Luis Enrique',
            'ap_paterno' => 'Valle',
            'ap_materno' => 'Brito',
            'nr_rut' => '7123779-6',
            'id_externo' => '45998',
            'email' => 'usuario3@example.com',
            'celular' => '333333333',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'nr_institucion' => 1,
        ])->assignRole($jefeDeptoRole);

        User::create([
            'nombres' => 'Raul Esteban',
            'ap_paterno' => 'Fredes',
            'ap_materno' => 'Gutierrez',
            'nr_rut' => '17950289-5',
            'id_externo' => '78954',
            'email' => 'raul@gmail.com',
            'celular' => '444444444',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'nr_institucion' => 1,

        ])->assignRole($funcionarioRole);
    }
}