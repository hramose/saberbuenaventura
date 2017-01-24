<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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
    public function messages(){
        return [
            'password.confirmed'                =>  'Las contraseñas no coinciden',
            'password_confirmation.required'    =>  'La confirmación de la contraseña es requerida',
            'password_confirmation.min:4'       =>  'La confirmación de la contraseña actual debe de ser minimo de 4 caracteres',
        ];
    }
    public function rules()
    {
        return [
            'password'              =>  'required|min:4|confirmed',
            'password_confirmation' =>  'required|min:4',
        ];
    }
}
