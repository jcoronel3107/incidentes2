<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminReservationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            /* 'admin_comment' => 'required|string|max:255', */
           
            'vehiculo_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            
            'vehiculo_id.required' => 'Campo Recurso a Asignar Solicitud Requerido'
        ];
    }
}
