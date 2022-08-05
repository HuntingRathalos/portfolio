<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterRequestTest extends TestCase
{
    // uniqueルールの検証に必要
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = User::factory()->create([
            'email' => 'aaa@example.com',
        ]);
    }

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
        $rules = (new RegisterRequest())->rules();

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
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            '名前必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => null,
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            '名前形式エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 123,
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            '名前形式エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 123,
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            '名前最大文字数エラー' => [
                'expected' => false,
                'data' => [
                    'name' => Str::random(256),
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'OK' => [
                'expected' => true,
                'data' => [
                    'name' => Str::random(255),
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'email必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => null,
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'email形式エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'email最大文字数エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => Str::random(256),
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'emailユニークエラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'aaa@example.com',
                    'password' => 'password',
                    'password_confirmation' => 'password',
                ],
            ],
            'password必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => null,
                    'password_confirmation' => null,
                ],
            ],
            'password最小文字数エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => 'pass',
                    'password_confirmation' => 'pass',
                ],
            ],
            'password一致エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'password111',
                ],
            ],
            '確認用password必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => null,
                ],
            ],
            '確認用password最小文字数エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'testUser',
                    'email' => 'test@test.com',
                    'password' => 'password',
                    'password_confirmation' => 'pass',
                ],
            ],
        ];
    }
}
