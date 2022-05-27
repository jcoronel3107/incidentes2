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
            
           
            'vehiculo_id' => 'required',
            'conductor_id'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            
            'vehiculo_id.required' => 'Campo Vehiculo a Asignar Requerido',
            'conductor_id.required' => 'Campo Conductor a Asignar Requerido'
        ];
    }
}
