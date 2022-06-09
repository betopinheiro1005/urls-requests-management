<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>  'required|min:4|max:70',
            'email' =>  'required|email',
            'password' => 'exclude_if:password,""|min:6|max:20|regex:/(^([a-zA-Z_-]+)(\d+)?$)/u|same:password_confirm|',
            'password_confirm' => 'exclude_if:password_confirm,""|min:6|max:20|regex:/(^([a-zA-Z_-]+)(\d+)?$)/u'
        ];
    }
}
