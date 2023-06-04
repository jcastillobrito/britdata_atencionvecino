<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institucion;


class InstitucionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('institucion')->delete();

        Institucion::create([
            'nm_institucion' => 'Institucion #1 ',
            'tp_activo' => 1
            ]);
        
        
        
    }
}