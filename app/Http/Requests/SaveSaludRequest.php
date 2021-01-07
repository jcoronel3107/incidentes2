<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSaludRequest extends FormRequest
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
                'tipo_escena'=>'required',
                'station_id'=>'required',
                'fecha'=>'required',
                'direccion'=>'required',
                'parroquia_id'=>'required',
                'ficha_ecu911'=>'required',
                'hora_fichaecu911'=>'required',
                'hora_salida_a_emergencia'=>'required',
                'informacion_inicial'=>'required|max:1000'
            ];
    }
}
