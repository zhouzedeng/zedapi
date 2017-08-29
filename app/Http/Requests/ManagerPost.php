<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerPost extends FormRequest
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
                'name' => 'required|string|max:30',
                'project' => 'required|string|max:30',
                'apply_user' => 'required|string|max:15',
                'apply_user_tel' => 'required|string|max:15',
                'apply_source' => 'required|string|max:15'
        ];
                
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() {
        return [
                'name.required' => '参数name不能为空',

    
        ];
    }
}
