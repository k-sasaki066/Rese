<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'address'=>['required'],
            'text'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'address.required'=>'宛先を選択してください',
            'text.required'=>'本文を入力してください',
        ];
    }
}
