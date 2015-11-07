<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PeriodoRequest extends Request
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
            'descripcion' => 'required|max:250',
            'ano_inicio' => 'required|numeric',
            'ano_fin' => 'required|numeric',
            'escuela_id' => 'required|numeric',
        ];
    }
}
