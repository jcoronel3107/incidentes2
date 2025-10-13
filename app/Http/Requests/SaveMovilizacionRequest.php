<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMovilizacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'fecha_salida'=>'required',
                'fecha_retorno'=>'required',
                'km_salida'=>'required',
                'km_retorno'=>'required',
                'user_id'=>'required',
                'observaciones'=>'nullable|max:500',
                'vehiculo_id'=>'required'
            ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fecha_salida.required' => 'A fecha_salida is required',
            'fecha_retorno.required' => 'A fecha_retorno is required',
            'km_salida.required' => 'A km_salida is required',
            'km_retorno.required' => 'A km_retorno is required',
            'user_id.required' => 'A user is required',
            'vehiculo_id.required' => 'A vehiculo is required',
        ];
    }
}
