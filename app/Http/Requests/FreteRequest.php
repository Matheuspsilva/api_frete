<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreteRequest extends FormRequest
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
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'status' => 'required',
            'veiculo_id' => 'required',
            'valor' => 'required'
        ];
    }
}
