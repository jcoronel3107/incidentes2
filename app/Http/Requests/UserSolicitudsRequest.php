<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSolicitudsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start'         => 'required',
            'end'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.max' => 'El campo de comentario debe tener como máximo 100 caracteres.',
            'start.required' => 'Campo start Requerido.',
            'start.before_or_equal' => 'La fecha de inicio debe ser menor o igual a la fecha Fin.',
            'end.after_or_equal' => 'La fecha Fin debe ser mayor o igual a la fecha Inicio.'
        ];
    }
}
