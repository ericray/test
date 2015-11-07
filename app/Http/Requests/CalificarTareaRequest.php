<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CalificarTareaRequest extends Request
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
            'evaluacion'    => 'required|numeric|max:10|min:0',
            'observaciones' => 'required|max:250',
            'alumno_id'     => 'required|integer',
            'tarea_id'      => 'required|integer',
            'periodo_id'    => 'required|integer'
        ];
    }
}
