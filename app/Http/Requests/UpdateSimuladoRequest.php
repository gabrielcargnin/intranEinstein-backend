<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSimuladoRequest extends FormRequest
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
            'id_simulado' => 'required',
            'data_inicio_inscricao' => 'required|date_format:"Y-m-d"|before:data_fim_inscricao',
            'data_fim_inscricao' => 'required|date_format:"Y-m-d"|after:data_inicio_inscricao',
            'modelo' => 'required',
            'datas_aplicacao' => 'required|json',
            'horarios_aplicacao' => 'required|json'
        ];
    }
}
