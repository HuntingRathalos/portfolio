<?php

namespace App\Http\Requests;

use Illuminate\contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirmation' => '確認用パスワード',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '正しい形式で入力してください',
            'name.max' => '文字数をオーバーしています。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しい形式で入力してください。',
            'email.max' => '文字数をオーバーしています。',
            'email.unique' => '登録済みのユーザーです',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードと確認用パスワードが一致していません。',
            'password_confirmation.required' => '確認用パスワードは必須です。',
            'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
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
