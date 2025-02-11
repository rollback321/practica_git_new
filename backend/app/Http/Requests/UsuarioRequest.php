<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('put')){
            return [
                'status' => ['required']
            ];
            //return "true put";
        } else {
            return [
                "us_nom_usuario" => ['required','max:50','min:8'],
                "us_password" => ['required','max:20','min:8'], 
                "us_nombres" => ['required','max:50'],  
                "us_paterno" => ['required', ' min:3', 'max:30'],
                "us_materno" => []  
                
            ];
        }
    }

    public function messages(): array
    {
        return [
            'us_nombres.required' => 'El campo es obligatorio', 
            'us_password.unique' => 'Error SQL unique',            
        ];
    }
}
