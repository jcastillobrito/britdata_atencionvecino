<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidad';
    protected $fillable = ['nm_unidad','tp_activo','nr_institucion'];

    public function deptos()
    {
        return $this->hasMany(Depto::class,'nr_unidad','id');
    }
}
