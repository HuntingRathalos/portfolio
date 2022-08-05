<?php

namespace App\Http\Requests;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TargetRequest extends FormRequest
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
            'name' => 'required|max:50',
            'amount' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '目標',
            'amount' => '目標額',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '目標は必須です。',
            'name.max' => '文字数をオーバーしています。',
            'amount.required' => '目標額は必須です。',
            'amount.integer' => '正しい形式で入力してください。',
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
