<?php

namespace tests\Unit\Requests;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SignupRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * バリデーションテスト
     *
     * @dataProvider signupUsersArgsValidationDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testSignupUsersArgsValidation(array $data, array $errors): void
    {
        $email = 'test@example.com';
        User::factory()->create(
            [
                'email' => $email,
            ]
        );

        $request = new SignupRequest();
        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * テストに渡すデータ
     */
    public function signupUsersArgsValidationDataProvider(): array
    {
        return [
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ],
            'メールアドレスがすでに存在する' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'test@example.com',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email has already been taken.'],
                ],
            ],
            'メールアドレスの形式が不正' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'invalid-email',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            'Edge: 実在するがRFC違反メールアドレス' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'ab..cd@example.com',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            'Edge: 実在するがRFC違反メールアドレス2' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'ab[cd@example.com',
                    'password' => 'password',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            //            'Edge: メールアドレス' => [
            //                'data' => [
            //                    'name' => "test",
            //                    'email' => '”ab..cd”@example.com',
            //                    'password' => 'password',
            //                ],
            //                'errors' => []
            //            ],
            '文字数が多すぎる' => [
                'data' => [
                    'name' => str_repeat('a', 65),
                    'email' => str_repeat('a', 244).'@example.com',
                    'password' => str_repeat('a', 33),
                ],
                'errors' => [
                    'name' => ['The name must not be greater than 64 characters.'],
                    'email' => ['The email must not be greater than 255 characters.'],
                    'password' => ['The password must not be greater than 32 characters.'],
                ],
            ],
        ];
    }
}
