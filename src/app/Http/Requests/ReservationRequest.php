<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required','after:today',],
            'time' => ['required'],
            'number' => ['required'],
        ];
    }

    public function messages() {
        return[
            'date.required'=>'予約日を入力してください',
            'date.after'=>'予約日は明日以降の日付で予約可能です',
            'time.required'=>'予約時間を入力してください',
            'number.required'=>'予約人数を入力してください',
        ];
    }
}
