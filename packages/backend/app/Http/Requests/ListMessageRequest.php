<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *   lastMessageId: string|null,
 *   perPage: int|null,
 * }>
 */
final class ListMessageRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'lastMessageId' => ['string'],
            'perPage' => ['integer'],
        ];
    }
}
