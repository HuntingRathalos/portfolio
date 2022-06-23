<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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
            'good_description' => 'max:60',
            'bad_description' => 'max:60',
            'self_evaluation' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'good_description' => '良かったポイント',
            'bad_description' => '悪かったポイント',
            'self_evaluation' => '自己評価'
        ];
    }

    public function messages()
    {
        return [
            // 'good_description.required' => '良かったポイントは必須です。',
            'good_description.max' => '文字数をオーバーしています。',
            // 'bad_description.required' => '悪かったポイントは必須です。',
            'bad_description.max' => '文字数をオーバーしています。',
            'self_evaluation.required' => '自己評価は必須です。',
            'self_evaluation.integer' => '正しい形式で入力してください。',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = response()->json([
            'status' => 'validation error',
            'errors' => $validator->errors()
        ], 400);
        throw new HttpResponseException($response);
    }
}
