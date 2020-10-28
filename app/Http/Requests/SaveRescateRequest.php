<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRescateRequest extends FormRequest
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
                'hora_llegada_a_emergencia'=>'required',
                'hora_fin_emergencia'=>'required',
                'hora_en_base'=>'required',
                'informacion_inicial'=>'required|max:1000',
                'detalle_emergencia'=>'required|max:1000',
                'usuario_afectado'=>'required',
                'danos_estimados'=>'required'
            ];
    }
}
