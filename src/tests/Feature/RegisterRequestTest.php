<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterRequestTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * RegisterRequestのバリデーションテスト
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

        $request = new RegisterRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        return [
            'OK' => [
                ['name', 'email', 'password'],
                ['テスト', 'test@example.com', 'test1234'],
                true
            ],
            '名前必須エラー' => [
                ['name', 'email', 'password'],
                [null, 'test@example.com', 'test1234'],
                false
            ],
            '名前形式エラー' => [
                ['name', 'email', 'password'],
                [1, 'test@example.com', 'test1234'],
                false
            ],
            '名前最大文字数エラー' => [
                ['name', 'email', 'password'],
                [str_repeat('a', 192), 'test@example.com', 'test1234'],
                false
            ],

            'メールアドレス必須エラー' => [
                ['name', 'email', 'password'],
                ['テスト', null, 'test1234'],
                false
            ],
            'メールアドレス形式エラー1' => [
                ['name', 'email', 'password'],
                ['テスト', examplecom, 'test1234'],
                false
            ],
            'メールアドレス形式エラー2' => [
                ['name', 'email', 'password'],
                ['テスト', 'test <test@example.com>', 'test1234'],
                false
            ],
            'メールアドレス形式エラー3' => [
                ['name', 'email', 'password'],
                ['テスト', 'test@', 'test1234'],
                false
            ],
            'メールアドレス形式エラー4' => [
                ['name', 'email', 'password'],
                ['テスト', '@example.com', 'test1234'],
                false
            ],
            'メールアドレス重複エラー' => [
                ['name', 'email', 'password'],
                ['テスト', $user->email, 'test1234'],
                false
            ],
            'メールアドレス最大文字数エラー' => [
                ['name', 'email', 'password'],
                ['テスト', str_repeat('a', 180).'@example.com', 'test1234'],
                false
            ],

            'パスワード必須エラー' => [
                ['name', 'email', 'password'],
                ['テスト', 'test@example.com', null],
                false
            ],
            'パスワード最小文字数エラー' => [
                ['name', 'email', 'password'],
                ['テスト', 'test@example.com', str_repeat('a', 7)],
                false
            ],
            'パスワード最大文字数エラー' => [
                ['name', 'email', 'password'],
                ['テスト', 'test@example.com', str_repeat('a', 192)],
                false
            ],
        ];
    }
}
