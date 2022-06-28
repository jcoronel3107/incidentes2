<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Mecanico extends Model
{
    use LogsActivity;
	use SoftDeletes;
    use HasFactory;

    protected $fillable=[
        "actividad",
        "user_id"
		];

    public static $actividad = ['Mecánico', 'Paramédico', 'Bomberos'];

    public function user(){
         
            return $this->belongsTo(User::class);
    }

    public function workorder(){
        
        return $this->belongsToMany(Workorder::class);
}
}
