<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *   newPassword: string,
 *   currentPassword: string
 * }>
 */
final class PasswordUpdateRequest extends ApiRequest
{
    /**
     * リクエストに適用するバリデーションルールを取得
     */
    public function rules(): array
    {
        return [
            'newPassword' => ['required', 'string', 'min:8', 'max:32'],
            'currentPassword' => ['required', 'string', 'min:8', 'max:32', 'current_password'],
        ];
    }
}
