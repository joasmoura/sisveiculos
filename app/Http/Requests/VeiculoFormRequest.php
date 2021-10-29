<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VeiculoFormRequest extends FormRequest
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
            'cor' => 'required_with_all:modelo, placa, cor',
            'tipo' => 'required_with_all:modelo, placa',
            'placa' => [
                'required_with_all:modelo',
                Rule::unique('veiculos', 'placa')->ignore($this->id)
            ],
            'modelo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cor.required_with_all' => 'Digite a cor do seu veículo!',
            'tipo.required_with_all' => 'Selecione o tipo do seu veículo!',
            'placa.unique' => 'Já existe um veículo cadastrado com a placa informada!',
            'placa.required_with_all' => 'Digite a placado seu veículo!',
            'modelo.required' => 'Digite o modelo do seu veículo!',
        ];
    }
}
