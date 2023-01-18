<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *   name: string,
 *   email: string,
 *   password: string
 * }>
 */
final class SignupRequest extends ApiRequest
{
    /**
     * リクエストに適用するバリデーションルールを取得
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ];
    }
}
