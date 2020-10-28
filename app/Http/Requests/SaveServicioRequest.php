<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveServicioRequest extends FormRequest
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
         
        return [
            
            'fecha_salida'=>'required',
            'fecha_retorno'=>'required',
            'unidad'=>'required',
            'delegante'=>'required',
            'km_salida'=>'required',
            'km_retorno'=>'required',
            'asunto'=>'required',
            'user_id'=>'required',
            'vehiculo_id'=>'required'
        ];
    }
}
