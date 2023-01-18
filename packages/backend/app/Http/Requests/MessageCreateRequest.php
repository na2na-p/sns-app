<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *     body: string,
 * }>
 */
final class MessageCreateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:140'],
        ];
    }
}
