<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentRequest extends Request
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
            'name'                  => 'required|min:2',
            'last_name'             => 'required|min:2',
            'type_document'         => 'required',
            'number_document'       => 'required|min:2|unique:students',
            'sex'                   => 'required',
            'birthday'              => 'required|min:2',
            'class_room_id'         => 'required',
            'email'                 => 'required|min:2|email|unique:students',
            'password'              => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ];
    }
}
