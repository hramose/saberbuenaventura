<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentUpdateRequest extends Request
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
            'name.required'      =>  'El nombre es requerido',
            'name.min:2'         =>  'El nombre debe de ser minimo de 2 caracteres',
            'last_name.required' =>  'El apellido es requerido',
            'last_name.min:2'    =>  'El apellido debe de ser minimo de 2 caracteres',
            'sex.required'       =>  'El sexo es requerido',
            'birthday.required'  =>  'La fecha de cumpleaños es requerida',
        ];
    }

    public function rules(){
        return [
            'name'      =>  'required|min:2',
            'last_name' =>  'required|min:4',
            'sex'       =>  'required',
            'birthday'  =>  'required',
        ];
    }
}
