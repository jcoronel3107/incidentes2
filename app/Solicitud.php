<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $fillable=[
        "title",
        "descripcion",
        "color",
        "textColor",
        "start",
        "end",
        "user_id",
        "status",
        "created_at"
        ];
    
    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime'
    ];

    public static $status = ['Solicitado', 'Confirmado', 'Cancelado'];

    public function user(){
		
		return $this->belongsTo(User::class);
	}

    public function Assignment(){
		
		return $this->hasOne(Assignment::class);
	}

    
}
