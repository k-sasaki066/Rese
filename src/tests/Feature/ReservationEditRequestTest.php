<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReservationEditRequest;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationEditRequestTest extends TestCase
{
    use RefreshDatabase;
    /**
     * LoginRequestのバリデーションテスト
     *
     * @param array 項目名
     * @param array 値
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataProviderExample
     */
    public function testExample(array $keys, array $values, bool $expect)
    {
        $nextDay = Carbon::now()->addDay()->format('Y-m-d');
        $data = [
            'date' => $nextDay,
            'time' => '15:00',
            'number' => '2',
        ];

        //入力項目の配列（$keys）と値の配列($values)から、連想配列を生成する
        $dataList = array_combine($keys, $values);

        $request = new ReservationEditRequest();
        //フォームリクエストで定義したルールを取得
        $rules = $request->rules();
        //Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($dataList, $rules);
        //入力情報がバリデーショルールを満たしている場合はtrue、満たしていな場合はfalseが返る
        $result = $validator->passes();
        //期待値($expect)と結果($result)を比較
        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        $nextDay = Carbon::now()->addDay()->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $subDay = Carbon::now()->subDay()->format('Y-m-d');
        return [
            'OK' => [
                ['date', 'time', 'number'],
                [$nextDay, '15:00', '2'],
                true
            ],
            'date必須エラー' => [
                ['date', 'time', 'number'],
                [null, '15:00', '2'],
                false
            ],
            'date日付エラー' => [
                ['date', 'time', 'number'],
                [$today, '15:00', '2'],
                false
            ],
            'date日付エラー2' => [
                ['date', 'time', 'number'],
                [$subDay, '15:00', '2'],
                false
            ],
            'time必須エラー' => [
                ['date', 'time', 'number'],
                [$nextDay, null, '2'],
                false
            ],
            'number必須エラー' => [
                ['date', 'time', 'number'],
                [$nextDay, '15:00', null],
                false
            ],
        ];
    }
}
