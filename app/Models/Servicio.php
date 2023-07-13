<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    
    protected $table    = 'services';
    
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

    public function Users()
    {
        return $this->belongsToMany(User::class, 'user_services', 'id_services', 'id_user');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'id_unidad');
    }

    public function depto()
    {
        return $this->belongsTo(Depto::class, 'id_depto');
    }

    
    
}
