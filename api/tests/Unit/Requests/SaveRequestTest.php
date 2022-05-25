<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SaveRequest;
use Illuminate\Support\Str;

class SaveRequestTest extends TestCase
{
   /**
     * @test
     * @dataProvider validationProvider
     *
     * テストの期待値
     * @param bool $expected
     *
     * フォームリクエストのモックデータ
     * @param array $data
     */
    public function バリデーションが通るか(bool $expected, array $data)
    {
        // フォームリクエストで定義したルールを取得
        $rules = (new SaveRequest())->rules();

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
                    'tag_id' => 1,
                    'icon_id' => 1,
                    'coin' => 5,
                    'memo' => 'メモ',
                    'click_date' => '2022-05-23',
                ]
            ],
            'tag_id必須エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => null,
                  'icon_id' => 1,
                  'coin' => 5,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'tag_id形式エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 'あああ',
                  'icon_id' => 1,
                  'coin' => 5,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'icon_id必須エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => null,
                  'coin' => 5,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'icon_id形式エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 'あああ',
                  'coin' => 5,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'coin必須エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => null,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'coin形式エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 'あああ',
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'OK' => [
                'expected' => true,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 50,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'coin枚数範囲外エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 51,
                  'memo' => 'メモ',
                  'click_date' => '2022-05-23',
              ]
            ],
            'memo形式エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 1,
                  'memo' => 123,
                  'click_date' => '2022-05-23',
              ]
            ],
            'OK' => [
                'expected' => true,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 1,
                  'memo' => Str::random(30),
                  'click_date' => '2022-05-23',
              ]
            ],
            'memo最大文字数エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 1,
                  'memo' => Str::random(31),
                  'click_date' => '2022-05-23',
              ]
            ],
            'click_date必須エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 1,
                  'memo' => 'メモ',
                  'click_date' => null,
              ]
            ],
            'click_date形式エラー' => [
                'expected' => false,
                'data' => [
                  'tag_id' => 1,
                  'icon_id' => 1,
                  'coin' => 1,
                  'memo' => 'メモ',
                  'click_date' => '日付',
              ]
            ],

        ];
    }

}
