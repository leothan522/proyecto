<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClapsRequest extends FormRequest
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
            'programa' => 'required',
            'municipios_id' => 'required',
            'parroquias_id' => 'required',
            'bloques_id' => 'required',
            'nombre_clap' => 'required|min:4',
            'comunidad' => 'required|min:4',
            'codigo_sica' => 'required|unique:claps'
        ];
    }
}
