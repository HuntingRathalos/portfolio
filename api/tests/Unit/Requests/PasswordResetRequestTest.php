<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\PasswordResetRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordResetRequestTest extends TestCase
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
        $rules = (new PasswordResetRequest())->rules();

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
                ],
            ],
            'email必須エラー' => [
                'expected' => false,
                'data' => [
                    'email' => null,
                ],
            ],
            'email形式エラー' => [
                'expected' => false,
                'data' => [
                    'email' => 'test@test.',
                ],
            ],
            'email最大文字数エラー' => [
                'expected' => false,
                'data' => [
                    'email' => Str::random(256),
                ],
            ],
        ];
    }
}
