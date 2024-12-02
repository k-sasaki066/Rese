<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください',
            'rating.integer' => '評価は整数を指定してください',
            'rating.min' => '評価には1以上の数値を指定してください',
            'rating.max' => '評価には5以下の数値を指定してください',
            'comment.required' => 'コメントを入力してください',
        ];
    }
}
