<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessTokenPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'grant_type'    => 'required|in:password',
            'client_id'     => 'required|numeric',
            'client_secret' => 'required|max:255',
            'username'      => 'required|min:1|max:64',
            'password'      => 'required|min:4|max:32',
            'scope'         => 'nullable',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() {
        return [
            'grant_type.required' => ':attribute.required',
            'grant_type.in'       => ':attribute.in',

            'client_id.required' => ':attribute.required',
            'client_id.numeric'  => ':attribute.numeric',

            'client_secret.required' => ':attribute.required',
            'client_secret.numeric'  => ':attribute.max',

            'username.required' => ':attribute.required',
            'username.min'      => ':attribute.min',
            'username.max'      => ':attribute.max',

            'password.required' => ':attribute.required',
            'password.min'      => ':attribute.min',
            'password.max'      => ':attribute.max',

        ];
    }
}
