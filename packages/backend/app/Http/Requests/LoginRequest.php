<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *   email: string,
 *   password: string
 * }>
 */
final class LoginRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ];
    }
}
