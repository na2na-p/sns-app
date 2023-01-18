<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @link https://laravel.com/docs/9.x/validation#form-request-validation
 *
 * @template T of array
 */
abstract class ApiRequest extends FormRequest
{
    /**
     * @Override
     * 勝手にリダイレクトさせない
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $data = [
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()->toArray(),
        ];

        throw new HttpResponseException(response()->json($data, 400));
    }

    /**
     * @return T
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        assert(is_array($validated));

        return $validated;
    }
}
