<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehiculoRequest extends FormRequest
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
        		'codigodis'=>'required',
                'placa'=>'required',
                'tipo'=>'required',
                'marca'=>'required',
                'modelo'=>'required',
                'clase'=>'required',
                'pais_orig'=>'required',
                'anio_fab'=>'required',
                'carroceria'=>'required',
                'color1'=>'required',
                'color2'=>'required',
                'tonelaje'=>'required',
                'cilindraje'=>'required',
                'motor'=>'required',
                'chasis'=>'required',
                'estacion'=>'required',
                'activo'=>'required',
                'responsab'=>'required',
                'kmmantrut'=>'required'
            ];

    }
}
