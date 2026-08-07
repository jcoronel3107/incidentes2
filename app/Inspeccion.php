<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspeccion extends Model
{
    use SoftDeletes;

    protected $table = 'inspeccions';

    protected $fillable = [
        'codigo_inspeccion',
        'fecha_inspeccion',
        'tipo_inspeccion',
        'lugar',
        'direccion',
        'ciudad',
        'provincia',
        'inspector_id',
        'cargo_inspector',
        'observaciones',
        'recomendaciones',
        'estado',
        'nivel_riesgo',
        'fecha_proxima_inspeccion',
        'documento_adjunto',
        'cumple_normativas',
    ];

    protected $casts = [
        'fecha_inspeccion' => 'date',
        'fecha_proxima_inspeccion' => 'date',
        'cumple_normativas' => 'boolean',
    ];

    // Relación con el usuario (inspector)
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
}