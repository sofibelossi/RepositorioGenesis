<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'=>'required|string|max:100',
            'precio'=>'required|numeric|max:100',
            'laboratorio'=>'required|string|max:100',
            'tipo'=>'required|string|max:100',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
    public function medicamentos(){
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.alpha' => 'El nombre solo debe contener letras.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.alpha' => 'El precio solo debe contener letras.',
            'laboratorio.required' => 'El laboratorio es obligatorio.',
            'laboratorio.alpha' => 'El laboratorio solo debe contener letras.',
            'tipo.required' => 'El tipo es obligatorio.',
        ];
    }
}
