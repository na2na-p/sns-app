<?php

namespace tests\Unit\Requests;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    protected LoginRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new LoginRequest();
    }

    /**
     * バリデーションテスト
     *
     * @dataProvider loginArgsValidationDataProvider
     *
     * @param array $data
     * @param array $errors
     * @param bool $expect
     * @return void
     */
    public function testLoginsArgsValidation(array $data, array $errors, bool $expect): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * テストに渡すデータ
     */
    public function loginArgsValidationDataProvider(): array
    {
        return [
            '正常系' => [
                'data' => [
                    'email' => 'bar@example.com',
                    'password' => 'password',
                ],
                'errors' => [],
                'expect' => true,
            ],
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
                'expect' => false,
            ],
            'メールアドレスの形式が不正' => [
                'data' => [
                    'email' => 'invalid-email',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
                'expect' => false,
            ],
            '文字数が多すぎる' => [
                'data' => [
                    'email' => str_repeat('a', 244) . '@example.com',
                    'password' => str_repeat('a', 33),
                ],
                'errors' => [
                    'email' => ['The email must not be greater than 255 characters.'],
                    'password' => ['The password must not be greater than 32 characters.'],
                ],
                'expect' => false,
            ],
        ];
    }
}
