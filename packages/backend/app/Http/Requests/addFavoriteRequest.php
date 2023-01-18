<?php

namespace App\Http\Requests;

/**
 * @extends ApiRequest<array{
 *     isFavorite: boolean,
 * }>
 */
final class addFavoriteRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'isFavorite' => ['required', 'boolean'],
        ];
    }
}
