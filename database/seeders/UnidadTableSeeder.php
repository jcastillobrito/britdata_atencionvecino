<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Unidad;

class UnidadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unidad')->delete();

        Unidad::insert([
            'id' => 1,
            'nombre' => 'Direccion de Desarrollo Comunitario',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 2,
            'nombre' => 'Direccion de Obras Municipales',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 3,
            'nombre' => 'Direccion de Tránsito',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 4,
            'nombre' => 'Administración Municipal',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 5,
            'nombre' => 'Direccion de Adminsitraciín y Finanzas',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 6,
            'nombre' => 'Direccion de Control',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 7,
            'nombre' => 'Direccion de Planificación Comunal',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 8,
            'nombre' => 'Direccion Jurídico',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 9,
            'nombre' => 'Secretaria Municipal',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 10,
            'nombre' => 'Jefa de Gabinete',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 11,
            'nombre' => 'Concejo Municipal',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Unidad::insert([
            'id' => 12,
            'nombre' => 'Juzgado Policial Local',
            'nr_institucion' => 1,
            'tp_activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        

        
        
        
    }
}