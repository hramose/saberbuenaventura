<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'current_password'      =>  'required',
            // 'password'              =>  'required',
            // 'password_confirmation' =>  'required',
        ];
    }

    // public function messages(){

    //     return [
    //         'current_password.required'         =>  'La contraseña actual es requerida',
    //         'current_password.min:4'            =>  'La contraseña actual debe de ser minimo de 4 caracteres',
    //         'password.confirmed'                =>  'Las contraseñas no coinciden',
    //         'password_confirmation.required'    =>  'La confirmación de la contraseña es requerida',
    //         'password_confirmation.min:4'       =>  'La confirmación de la contraseña actual debe de ser minimo de 4 caracteres',
    //     ];
    // }
}
