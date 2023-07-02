<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    
    protected $table = 'servicios';
    
    protected $fillable = [
                            'nombre',
                            'nr_institucion',
                            'tp_activo',
                            'id_unidad',
                            'id_depto',
                            'tp_resp_automatica',
                            'resp_automatica',
                            'nr_dias_plazo',
                            'descripcion_servicio'
                        ];

    
    
}
