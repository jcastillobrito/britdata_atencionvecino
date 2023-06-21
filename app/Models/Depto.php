<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depto extends Model
{
    use HasFactory;
    protected $table = 'depto';
    protected $fillable = ['nm_depto','tp_activo','nr_unidad','nr_institucion'];

    public function secciones()
    {
        return $this->hasMany(Seccion::class,'nr_depto','id');
    }
}
