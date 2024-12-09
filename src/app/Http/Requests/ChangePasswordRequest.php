<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'email'=>['required', 'email', 'string', 'max:191',
            function ($attribute, $value, $fail) {
                if (Auth::user()->email !== $value) {
                    $fail('登録されているメールアドレスと異なります。');
                }
            },],
            'oldPassword'=>['required',
            function ($attribute, $value, $fail) {
                if (password_verify($value, Auth::user()->password) == false) {
                    $fail('登録されているパスワードと異なります。');
                }
            },],
            'newPassword'=>['required', 'min:8', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'メールアドレスを入力してください',
            'email.email'=>'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.string'=>'メールアドレスは文字列で入力してください',
            'email.max'=>'メールアドレスは191文字以下で入力してください',
            'email.unique'=>'このメールアドレスは既に使用されています',
            'oldPassword.required'=>'現在のパスワードを入力してください',
            'newPassword.required'=>'新しいパスワードを入力してください',
            'newPassword.min'=>'新しいパスワードは8文字以上で設定してください',
            'newPassword.max'=>'新しいパスワードは191文字以下で設定してください',
        ];
    }
}
