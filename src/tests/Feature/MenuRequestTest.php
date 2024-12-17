<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\MenuRequest;

class MenuRequestTest extends TestCase
{
    use RefreshDatabase;
    /**
     * MenuRequestのバリデーションテスト
     *
     * @param array 項目名
     * @param array 値
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataProviderExample
     */
    public function testExample(array $keys, array $values, bool $expect)
    {

        $dataList = array_combine($keys, $values);

        $request = new MenuRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        return [
            'OK' => [
                ['name', 'price', 'detail',],
                ['テストAセット', '1500', '当店自慢のカレーにナン、サラダ、デザートのセットメニューです。'],
                true
            ],
            'name必須エラー' => [
                ['name', 'price', 'detail',],
                [null, '1500', '当店自慢のカレーにナン、サラダ、デザートのセットメニューです。'],
                false
            ],
            'price必須エラー' => [
                ['name', 'price', 'detail',],
                ['テストAセット', null, '当店自慢のカレーにナン、サラダ、デザートのセットメニューです。'],
                false
            ],
            'price全角数字エラー' => [
                ['name', 'price', 'detail',],
                ['テストAセット', '１５００', '当店自慢のカレーにナン、サラダ、デザートのセットメニューです。'],
                false
            ],
            'detail必須エラー' => [
                ['name', 'price', 'detail',],
                ['テストAセット', '1500', null],
                false
            ],
        ];
    }
}
