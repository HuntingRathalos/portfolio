<?php

namespace App\Http\Requests;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag_id' => 'required|integer',
            'icon_id' => 'required|integer',
            'coin' => 'required|numeric|between:-50,50',
            'memo' => 'required|string|max:30',
            'click_date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'tag_id' => 'タグID',
            'icon_id' => 'アイコンID',
            'coin' => 'コイン',
            'memo' => 'メモ',
            'click_date' => '日付',
        ];
    }

    public function messages()
    {
        return [
            'tag_id.required' => 'タグIDは必須です。',
            'tag_id.integer' => '正しい形式で入力してください。',
            'icon_id.required' => 'アイコンIDは必須です。',
            'icon_id.integer' => '正しい形式で入力してください。',
            'coin.required' => 'コインの枚数は必須です。',
            'coin.numeric' => '正しい形式で入力してください。',
            'coin.between' => 'コインの枚数は-50~50の範囲で入力してください。',
            'memo.string' => '正しい形式で入力してください。',
            'memo.max' => '文字数をオーバーしています。',
            'click_date.required' => '日付は必須です。',
            'click_date.date' => '正しい形式で入力してください。',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = response()->json([
            'status' => 'validation error',
            'errors' => $validator->errors(),
        ], 400);

        throw new HttpResponseException($response);
    }
}
