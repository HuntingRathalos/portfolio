<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginFormRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider validationProvider
     *
     * テストの期待値
     *
     * @param bool $expected
     *
     * フォームリクエストのモックデータ
     * @param array $data
     */
    public function バリデーションが通るか(bool $expected, array $data)
    {
        // フォームリクエストで定義したルールを取得
        $rules = (new LoginFormRequest())->rules();

        // Validatorファサードでバリデーターインスタンス取得、引数に入力情報とルールを渡す
        $validator = Validator::make($data, $rules);

        $this->assertEquals($expected, $validator->passes());
    }

    public function validationProvider()
    {
        return [
            'OK' => [
                'expected' => true,
                'data' => [
                    'email' => 'test@test.com',
                    'password' => 'password',
                ],
            ],
            'email必須エラー' => [
                'expected' => false,
                'data' => [
                    'email' => null,
                    'password' => 'password',
                ],
            ],
            'email形式エラー' => [
                'expected' => false,
                'data' => [
                    'email' => 'test@test.',
                    'password' => 'password',
                ],
            ],
            'email最大文字数エラー' => [
                'expected' => false,
                'data' => [
                    'email' => Str::random(256),
                    'password' => 'password',
                ],
            ],
            'password必須エラー' => [
                'expected' => false,
                'data' => [
                    'email' => 'test@test.',
                    'password' => null,
                ],
            ],
            'password最小文字数エラー' => [
                'expected' => false,
                'data' => [
                    'email' => 'test@test.',
                    'password' => 'pass',
                ],
            ],
        ];
    }
}
