<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //rol del usuario
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    //perfil del usuario relacion 1:1
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /* Relacion de 1:n de usuario a prestamos*/
    public function prestamo(){
        //tiene relacion 1:n con prestamo ::class importa el modelo
        return $this->hasMany(Prestamo::class);
    }
    /* Relacion de 1:n de usuario a solicitudes*/
    public function solicitud(){
        //tiene relacion 1:n con solicitud ::class importa el modelo
        return $this->hasMany(Solicitud::class);
    }

    public function reserva(){
        return $this->hasMany(Reserva::class);
    }
}
