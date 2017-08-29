<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGet extends FormRequest
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
            'phone'         => 'required',
            'username'  => 'required',  
            'sex' => 'min:1|numeric|max:2',
            'nickname' => 'required',
            'openid'   => 'required',
            'headimgurl' => 'required',            
            'appkey'=>'required|numeric',
        ];
    }
}
