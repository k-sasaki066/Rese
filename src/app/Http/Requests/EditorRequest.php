<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorRequest extends FormRequest
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
            'address'=>['required'],
            'tel1'=>['required', 'max:5', 'regex:/^[0-9]+$/'],
            'tel2'=>['required', 'max:5', 'regex:/^[0-9]+$/'],
            'tel3'=>['required', 'max:5', 'regex:/^[0-9]+$/'],
            'opening_time'=>['required'],
            'closing_time'=>['required'],
            'holiday'=>['required'],
            'max_number'=>['required', 'regex:/^[0-9]+$/'],
            'budget'=>['required', 'regex:/^[0-9]+$/'],
            'image_url'=>['required'],
            'area_id'=>['required'],
            'genre_id'=>['required'],
            'detail'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'お名前を入力してください',
            'address.required'=>'店舗住所を入力してください',
            'tel1.required'=>'電話番号を入力してください',
            'tel1.regex' => '電話番号は半角数字で入力してください',
            'tel1.max' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.regex' => '電話番号は半角数字で入力してください',
            'tel2.max' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.regex' => '電話番号は半角数字で入力してください',
            'tel3.max' => '電話番号は5桁までの数字で入力してください',
            'opening_time.required'=>'開店時間を入力してください',
            'closing_time.required'=>'閉店時間を入力してください',
            'holiday.required'=>'定休日を入力してください',
            'max_number.required'=>'席数を入力してください',
            'max_number.regex' => '席数は半角数字で入力してください',
            'budget.required'=>'平均予算を入力してください',
            'budget.regex' => '平均予算は半角数字で入力してください',
            'image_url.required'=>'画像URLを選択してください',
            'area_id.required'=>'エリアを選択してください',
            'genre_id.required'=>'ジャンルを選択してください',
            'detail.required'=>'店舗説明を入力してください',
        ];
    }
}
