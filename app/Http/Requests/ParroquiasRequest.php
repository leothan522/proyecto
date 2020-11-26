<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParroquiasRequest extends FormRequest
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
            'municipios_id' => 'required',
            'nombre_completo' => 'required|min:4|unique:parroquias',
            'nombre_corto' => 'required|min:4'
        ];
    }
}
