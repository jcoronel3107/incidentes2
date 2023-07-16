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
            'combustible'         => 'required',
            'vehiculo_id'         => 'required',
            'user_id'             => 'required'
        ];
    }

    public function messages()
    {
        return [
            'combustible.required' => 'El campo Combustible es requerido.',
            'vehiculo_id.required' => 'EL campo Vehiculo es requerido.',
            'user_id.required' => 'El campo Usuario es requerido.',
        ];
    }
}
