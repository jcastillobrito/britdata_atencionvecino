<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombres' => 'Super ',
                'ap_paterno' => 'Admin',
                'ap_materno' => 'Admin',
                'nr_rut' => '11111111-1',
                'id_externo' => '4578',
                'email' => 'supeadmin@gmail.com',
                'celular' => '+56945897483',
                'email_verified_at' => '2023-07-15 21:54:31',
                'password' => '$2y$10$RRM/mov9xi7WAyK60munZOAS6ZWMOlPKU7Z8wxmk/SnC5P6q/I0gq',
                'nr_institucion' => 1,
                'last_login' => NULL,
                'nr_unidad' => 1,
                'nr_depto' => NULL,
                'nr_seccion' => NULL,
                'tp_activo' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-07-15 21:54:31',
                'updated_at' => '2023-07-15 21:54:31',
            ),
            1 => 
            array (
                'id' => 2,
                'nombres' => 'Juan Carlos',
                'ap_paterno' => 'Castillo',
                'ap_materno' => 'brito',
                'nr_rut' => '18241152-3',
                'id_externo' => '4578',
                'email' => 'jccastillo.brito@gmail.com',
                'celular' => '+56945897482',
                'email_verified_at' => '2023-07-15 21:54:31',
                'password' => '$2y$10$K8GAxwqNVF3sVLgH3B5TDehlR.JQ6u3e.egYNu2gXOo8VfwvFFKRe',
                'nr_institucion' => 1,
                'last_login' => '2023-07-18 21:51:27',
                'nr_unidad' => 1,
                'nr_depto' => NULL,
                'nr_seccion' => NULL,
                'tp_activo' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-07-15 21:54:31',
                'updated_at' => '2023-07-18 21:51:27',
            ),
            2 => 
            array (
                'id' => 3,
                'nombres' => 'Francisca Salome',
                'ap_paterno' => 'Herrera',
                'ap_materno' => 'Contreras',
                'nr_rut' => '19577035-2',
                'id_externo' => '458',
                'email' => 'francisca@gmail.com',
                'celular' => '222222222',
                'email_verified_at' => '2023-07-15 21:54:31',
                'password' => '$2y$10$4SL.cZUdpnrH4bR.vNNv/ewDqBPuQGKTtU6A7VkMfv2.rqIr.sFiq',
                'nr_institucion' => 1,
                'last_login' => NULL,
                'nr_unidad' => 1,
                'nr_depto' => 0,
                'nr_seccion' => NULL,
                'tp_activo' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-07-15 21:54:31',
                'updated_at' => '2023-07-15 22:01:02',
            ),
            3 => 
            array (
                'id' => 4,
                'nombres' => 'Luis Enrique',
                'ap_paterno' => 'Valle',
                'ap_materno' => 'Brito',
                'nr_rut' => '7123779-6',
                'id_externo' => '45998',
                'email' => 'usuario3@example.com',
                'celular' => '333333333',
                'email_verified_at' => '2023-07-15 21:54:31',
                'password' => '$2y$10$5J/xrmPA/OEgDYmTPRhCvuvF8YXaJXF3JFXztFc5yqstSLYSdZFVu',
                'nr_institucion' => 1,
                'last_login' => NULL,
                'nr_unidad' => 1,
                'nr_depto' => NULL,
                'nr_seccion' => NULL,
                'tp_activo' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-07-15 21:54:31',
                'updated_at' => '2023-07-15 21:54:31',
            ),
            4 => 
            array (
                'id' => 5,
                'nombres' => 'Raul Esteban',
                'ap_paterno' => 'Fredes',
                'ap_materno' => 'Gutierrez',
                'nr_rut' => '17950289-5',
                'id_externo' => '78954',
                'email' => 'raul@gmail.com',
                'celular' => '444444444',
                'email_verified_at' => '2023-07-15 21:54:31',
                'password' => '$2y$10$fGaTTh/tm2QxuW8lYLUHR.4rEgxVydiJzxliiHIocZt00JZqDiIfq',
                'nr_institucion' => 1,
                'last_login' => NULL,
                'nr_unidad' => 1,
                'nr_depto' => NULL,
                'nr_seccion' => NULL,
                'tp_activo' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-07-15 21:54:31',
                'updated_at' => '2023-07-15 21:54:31',
            ),
        ));
        
        
    }
}