<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPost extends FormRequest
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
            'follower'         => 'required|max:128',
            'bridegroom_name'  => 'required_without:bride_name|max:64',
            'bridegroom_phone' => 'required_without:bride_phone|max:11',
            'bride_name'       => 'required_without:bridegroom_name|max:64',
            'bride_phone'      => 'required_without:bridegroom_phone|max:11',

            'province' => 'max:255',
            'city'     => 'max:255',
            'address'  => 'max:255',

            'shoot_at' => 'required|date',

            'discount' => 'numeric|max:2147483647',

            '_album_id' => 'required',
            '_combo_id' => 'required',

            'album_photos'   => 'array',
            'album_photos.*' => 'required',

            'studios'   => 'array',
            'studios.*' => 'required',

            'clothings'   => 'array',
            'clothings.*' => 'required',

            'products'         => 'array',
            'products.*._id'   => 'required',
            'products.*.count' => 'required|numeric|min:1|max:2147483647',

            'extras'           => 'array',
            'extras.*.content' => 'required',
            'extras.*.money'   => 'required|numeric|min:1|max:2147483647',

            'remark' => 'max:5000',
        ];
    }
}
