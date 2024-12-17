<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReservationRequest;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationRequestTest extends TestCase
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
            'menu_name'  => '仙人-Aコース',
            'payment'  => 'クレジットカード事前決済',
        ];

        //入力項目の配列（$keys）と値の配列($values)から、連想配列を生成する
        $dataList = array_combine($keys, $values);

        $request = new ReservationRequest();
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
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$nextDay, '15:00', '2', '仙人-Aコース', 'クレジットカード事前決済',],
                true
            ],
            'date必須エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [null, '15:00', '2', '仙人-Aコース', 'クレジットカード事前決済',],
                false
            ],
            'date日付エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$today, '15:00', '2', '仙人-Aコース', 'クレジットカード事前決済',],
                false
            ],
            'date日付エラー2' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$subDay, '15:00', '2', '仙人-Aコース', 'クレジットカード事前決済',],
                false
            ],
            'time必須エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$nextDay, null, '2', '仙人-Aコース', 'クレジットカード事前決済',],
                false
            ],
            'number必須エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$nextDay, '15:00', null, '仙人-Aコース', 'クレジットカード事前決済',],
                false
            ],
            'menu_name必須エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$nextDay, '15:00', '2', null, 'クレジットカード事前決済',],
                false
            ],
            'payment必須エラー' => [
                ['date', 'time', 'number', 'menu_name', 'payment'],
                [$nextDay, '15:00', '2', '仙人-Aコース', null,],
                false
            ],
        ];
    }

}
