<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveClaveRequest extends FormRequest
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
            //
			'km_salida'=>'required',
            'km_gasolinera'=>'required',
            'km_llegada'=>'required',
            'dolares'=>'required',
            'galones'=>'required'
        ];
    }
}
