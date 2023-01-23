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
     * @dataProvider loginArgsValidationInvalidDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testLoginsArgsValidationFailed(array $data, array $errors): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * 異常系テストに渡すデータ
     */
    public function loginArgsValidationInvalidDataProvider(): array
    {
        return [
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ],
            'メールアドレスの形式が不正' => [
                'data' => [
                    'email' => 'invalid-email',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            '文字数が多すぎる' => [
                'data' => [
                    'email' => str_repeat('a', 244).'@example.com',
                    'password' => str_repeat('a', 33),
                ],
                'errors' => [
                    'email' => ['The email must not be greater than 255 characters.'],
                    'password' => ['The password must not be greater than 32 characters.'],
                ],
            ],
        ];
    }

    /**
     * バリデーションテスト(正常系)
     *
     * @dataProvider loginArgsValidationValidDataProvider
     *
     * @param  array  $data
     * @return void
     */
    public function testLoginsArgsValidationSuccess(array $data): void
    {
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(true, $result);
    }

    /**
     * テストに渡すデータ
     */
    public function loginArgsValidationValidDataProvider(): array
    {
        return [
            '正常系' => [
                'data' => [
                    'email' => 'bar@example.com',
                    'password' => 'password',
                ],
            ],
        ];
    }
}
