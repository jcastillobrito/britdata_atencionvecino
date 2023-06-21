<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Depto;

class DeptoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('depto')->delete();

        Depto::insert([
            'id' => 1,
            'nombre' => 'Asistencia Social',
            'nr_unidad' => 1,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 2,
            'nombre' => 'Vivienda',
            'nr_unidad' => 1,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 3,
            'nombre' => 'OMIL',
            'nr_unidad' => 1,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 4,
            'nombre' => 'Discapacidad',
            'nr_unidad' => 1,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        Depto::insert([
            'id' => 5,
            'nombre' => 'Catastro e Inspección',
            'nr_unidad' => 2,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 6,
            'nombre' => 'Bodega Municipal',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 7,
            'nombre' => 'Oficina de Computación e Informatica',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Depto::insert([
            'id' => 8,
            'nombre' => 'Oficina de Comunicaciones',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 9,
            'nombre' => 'Departamento de Operaciones y Emergencias',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 10,
            'nombre' => 'Oficina de Partes',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 11,    
            'nombre' => 'Departamento de Deporte',
            'nr_unidad' => 4,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 12,
            'nombre' => 'Tesoreria Municipal',
            'nr_unidad' => 5,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 13,
            'nombre' => 'Oficina de Personal',
            'nr_unidad' => 5,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 14,
            'nombre' => 'Adquisiciones',
            'nr_unidad' => 5,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id' => 15,
            'nombre' => 'Inspección y Patentes',
            'nr_unidad' => 5,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 16,
            'nombre' => 'Transparencia',
            'nr_unidad' => 6,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 17,
            'nombre' => 'Prevención de Riesgos',
            'nr_unidad' => 6,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 18,
            'nombre' => 'Auditorias',
            'nr_unidad' => 6,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 19,
            'nombre' => 'Departamento de Proyección',
            'nr_unidad' => 7,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 20,
            'nombre' => 'Fomento Productivo',
            'nr_unidad' => 7,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 21,
            'nombre' => 'Turismo',
            'nr_unidad' => 7,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 22,
            'nombre' => 'Programa de Desarrollo Social',
            'nr_unidad' => 7,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        Depto::insert([
            'id'=> 23,
            'nombre' => 'Medio Ambiente',
            'nr_unidad' => 8,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Depto::insert([
            'id'=> 24,
            'nombre' => 'Organizaciones Comunitarias',
            'nr_unidad' => 9,
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}