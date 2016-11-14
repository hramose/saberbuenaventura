<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InstitutionCreate extends Request
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
            'name'                  => 'required',
            'street_address'        => 'required',
            'phone'                 => 'required',
            'email'                 => 'required|min:5|unique:institutions',
            'password'              => 'required|min:4|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
