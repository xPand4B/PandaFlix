<?php

// TODO: Implement Waavi\Sanitizer?

namespace App\Components\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'firstname' => 'required|alpha|min:1|max:255',
            'lastname'  => 'required|alpha|min:1|max:255',
            'username'  => 'required|alpha_num|unique:users|min:3|max:255',
            'email'     => 'required|email|unique:users|max:255',
            'birthday'  => 'nullable|date',
            'password'  => 'required|confirmed|max:255'
        ];
    }
}
