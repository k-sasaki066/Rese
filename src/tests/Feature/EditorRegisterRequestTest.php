<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditorRegisterRequest;
use App\Models\User;

class EditorRegisterRequestTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * EditorRegisterRequestのバリデーションテスト
     *
     * @param array 項目名
     * @param array 値
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataProviderExample
     */
    public function testExample(array $keys, array $values, bool $expect)
    {
        $user = User::factory()->create();
        $dataList = array_combine($keys, $values);

        $request = new EditorRegisterRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        return [
            'OK' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@example.com', 'test1234', '1'],
                true
            ],
            '名前必須エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                [null, 'test@example.com', 'test1234', '1'],
                false
            ],
            '名前形式エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                [1, 'test@example.com', 'test1234', '1'],
                false
            ],
            '名前最大文字数エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                [str_repeat('a', 192), 'test@example.com', 'test1234', '1'],
                false
            ],

            'メールアドレス必須エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', null, 'test1234', '1'],
                false
            ],
            'メールアドレス形式エラー1' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', examplecom, 'test1234', '1'],
                false
            ],
            'メールアドレス形式エラー2' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test <test@example.com>', 'test1234', '1'],
                false
            ],
            'メールアドレス形式エラー3' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@', 'test1234', '1'],
                false
            ],
            'メールアドレス形式エラー4' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', '@example.com', 'test1234', '1'],
                false
            ],
            'メールアドレス重複エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', $user->email, 'test1234', '1'],
                false
            ],
            'メールアドレス最大文字数エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', str_repeat('a', 180).'@example.com', 'test1234', '1'],
                false
            ],

            'パスワード必須エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@example.com', null, '1'],
                false
            ],
            'パスワード最小文字数エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@example.com', str_repeat('a', 7), '1'],
                false
            ],
            'パスワード最大文字数エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@example.com', str_repeat('a', 192), '1'],
                false
            ],
            '店舗必須エラー' => [
                ['name', 'email', 'password', 'shop_id'],
                ['店舗花子', 'test@example.com', 'test1234', null],
                false
            ],
        ];
    }
}
