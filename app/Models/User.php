<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,AuditableTrait;

    protected $guarded = [];
    
    protected $fillable = [
        'password',
        'nombres',
        'ap_paterno',
        'ap_materno',
        'nr_rut',
        'id_externo',
        'email',
        'telefono',
        'email',
        'nr_institucion',
        'last_login',
        'nr_unidad',
        'nr_depto',
        'tp_activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

 

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class,'nr_institucion','id');
    }

    public function Unidad()
    {
        return $this->belongsTo(Unidad::class,'nr_unidad','id');
    }

    public function Depto()
    {
        return $this->belongsTo(Depto::class,'nr_depto','id');
    }

   
}
