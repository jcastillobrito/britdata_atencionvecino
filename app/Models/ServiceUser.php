<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    use HasFactory;

    protected $table = 'user_services';

    protected $fillable = [
        'id_user',
        'id_service',
        'tp_activo',
        'tp_respuesta_final',
        'tp_derivacion',
        'tp_responsable',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
