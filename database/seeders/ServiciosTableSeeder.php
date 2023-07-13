<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiciosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Multa TAG',
                'nr_institucion' => 1,
                'tp_activo' => 1,
                'id_unidad' => 1,
                'id_depto' => 1,
                'tp_resp_automatica' => 0,
                'resp_automatica' => NULL,
                'nr_dias_plazo' => NULL,
                'descripcion_servicio' => 'Servicio asociado a las multas indebidas o errores de sistema',
                'created_at' => '2023-07-12 22:35:47',
                'updated_at' => '2023-07-12 22:35:47',
            ),
        ));
        
        
    }
}