<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;
    protected static $logAttributes = ['name', 'email', 'avatar', 'deleted_at'];
    protected static $logOnlyDirty = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cargo','avatar'
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



	public function EsAdmin(){
		if($this->Rol->nombre=='administrador'){
			return true;
	}
		return false;
	}

    public function clave(){
        //Muestra informacion de las Claves Realizadas por gasolinera
    return $this->hasMany(Clave::class);
    }

    public function inundacions(){
        return $this->belongsToMany(Inundacion::class);
    }
    public function incendios(){
        return $this->belongsToMany(Incendio::class);
    }
    public function rescates(){
        return $this->belongsToMany(Rescate::class);
    }
    public function fugas(){
        return $this->belongsToMany(Fuga::class);
    }

    public function derrames(){
        return $this->belongsToMany(Derrame::class);
    }

    public function transitos(){
        return $this->belongsToMany(Transito::class);
    }

    public function saluds(){
        return $this->belongsToMany(Salud::class);
    }

    public function solicitud(){
        //Muestra informacion de las Claves Realizadas por gasolinera
    return $this->hasMany(Solicitud::class);
    }

    public function mecanico(){
        //Muestra informacion del vehiculo en la clave consultada
        return $this->hasOne(Mecanico::class);
}
    
}