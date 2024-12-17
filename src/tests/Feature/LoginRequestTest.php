<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginRequestTest extends TestCase
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
        $data = [
            'name' => 'test',
            'email' => 'test@email.com',
            'password'  => 'test1234',
        ];

        $dataList = array_combine($keys, $values);

        $request = new LoginRequest();
        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataProviderExample()
    {
        return [
            'OK' => [
                ['email', 'password'],
                ['test@example.com', 'test1234'],
                true
            ],
            'メールアドレス形式エラー1' => [
                ['email', 'password'],
                ['testexample.com', 'test1234'],
                false
            ],
            'メールアドレス形式エラー2' => [
                ['email', 'password'],
                ['testexamplecom', 'test1234'],
                false
            ],
            'メールアドレス形式エラー3' => [
                ['email', 'password'],
                ['test@', 'test1234'],
                false
            ],
            'メールアドレス形式エラー4' => [
                ['email', 'password'],
                ['example.com', 'test1234'],
                false
            ],
            'メールアドレス必須エラー' => [
                ['email', 'password'],
                [null, 'test1234'],
                false
            ],

            'パスワード必須エラー' => [
                ['email', 'password'],
                ['test@email.com', null],
                false
            ],
        ];
    }
}
