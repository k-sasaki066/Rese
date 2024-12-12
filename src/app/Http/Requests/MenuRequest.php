<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name'=>['required'],
            'price'=>['required', 'regex:/^[0-9]+$/'],
            'detail'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'メニュー名を入力してください',
            'price.required'=>'価格を入力してください',
            'price.regex'=>'価格は半角数字のみで入力してください',
            'detail.required'=>'説明を入力してください',
        ];
    }
}
