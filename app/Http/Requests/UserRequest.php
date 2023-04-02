<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'nombre'=>'required|min:4',
            'correo'=>'required|min:3|unique:users,email',
            'role'=>'required',
        ];
        if($this->filled('password')){
            $rules['password'] = ['required','confirmed','min:5'];
       }
       return $rules;
    }
}
