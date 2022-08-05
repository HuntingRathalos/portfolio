<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\TargetRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class TargetRequestTest extends TestCase
{
    /**
     * @test
     * @dataProvider validationProvider
     *
     * テストの期待値
     *
     * @param bool  $expected
     *                        フォームリクエストのモックデータ
     * @param array $data
     */
    public function バリデーションが通るか(bool $expected, array $data)
    {
        // フォームリクエストで定義したルールを取得
        $rules = (new TargetRequest())->rules();

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
                    'name' => 'お菓子買う',
                    'amount' => 30000,
                ],
            ],
            'name必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => null,
                    'amount' => 30000,
                ],
            ],
            'name最大文字数エラー' => [
                'expected' => false,
                'data' => [
                    'name' => Str::random(51),
                    'amount' => 30000,
                ],
            ],
            'amount必須エラー' => [
                'expected' => false,
                'data' => [
                    'name' => 'お菓子買う',
                    'amount' => null,
                ],
            ],
        ];
    }
}
