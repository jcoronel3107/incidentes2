<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
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
        "equipment_id",
        "status",
        "admin_comment",
        "created_at"
        ];
    //protected $guarded = [];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime'
    ];

    public static $status = ['Solicitado', 'Confirmado', 'Cancelado'];

   
}
