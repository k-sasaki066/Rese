<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditorRequest;
use App\Models\User;

class EditorRequestTest extends TestCase
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

        $dataList = array_combine($keys, $values);

        $request = new EditorRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        return [
            'OK' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                true
            ],
            'name必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                [null, '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'address必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', null, '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'tel必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', null, '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'tel最大文字数エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890-344', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'tel全角数字エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '１２３−４５６−７８９０', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'telハイフンなしエラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '1234567890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '開店時間必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', null, '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '閉店時間必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', null, [0 => "月",1 => "火"], '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '定休日必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', null, '10', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '席数必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], null, '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '席数全角数字エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '１０', '2000', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '平均予算必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', null, '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '平均予算全角数字エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '２０００', '1', '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'エリア必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', null, '3', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            'ジャンル必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', null, '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。',],
                false
            ],
            '説明必須エラー' => [
                ['name', 'address', 'tel', 'opening_time', 'closing_time', 'holiday', 'max_number', 'budget', 'area_id', 'genre_id', 'detail',],
                ['テスト', '東京都渋谷区千駄ヶ谷1-2-3', '123-456-7890', '15:00', '20:00', [0 => "月",1 => "火"], '10', '2000', '1', '3', null,],
                false
            ],
        ];
    }
}
