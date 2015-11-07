<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AlumnoRequest extends Request
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
            'name' => 'required|max:250',
            'lastname' => 'required|max:250',
            'lastname2' => 'required|max:250',
            'email' => 'required|email:users|max:250',
            'password' => 'required|max:250|min:8',
            'estado_id' => 'required|numeric',
            'escuela_id' => 'required|numeric',
            'grupo_id' => 'required|numeric',
            'sexo_id' => 'required|numeric'
        ];
    }
}
