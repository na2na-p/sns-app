<?php

namespace tests\Unit\Requests;

use App\Http\Requests\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    protected PasswordUpdateRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new PasswordUpdateRequest();
    }

    /**
     * バリデーションテスト
     *
     * @dataProvider signupUsersArgsValidationDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testSignupUsersArgsValidation(array $data, array $errors, bool $expect): void
    {
        $currentPassword = 'password';
        $user = User::factory()->create(
            [
                'password' => Hash::make($currentPassword),
            ]
        );
        $this->actingAs($user);
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * テストに渡すデータ
     */
    public function signupUsersArgsValidationDataProvider(): array
    {
        return [
            '正常系' => [
                'data' => [
                    'currentPassword' => 'password',
                    'newPassword' => 'new-password',
                ],
                'errors' => [],
                'expected' => true,
            ],
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'currentPassword' => ['The current password field is required.'],
                    'newPassword' => ['The new password field is required.'],
                ],
                'expect' => false,
            ],
            '文字数が多すぎる' => [
                'data' => [
                    'currentPassword' => 'password',
                    'newPassword' => str_repeat('a', 33),
                ],
                'errors' => [
                    'newPassword' => ['The new password must not be greater than 32 characters.'],
                ],
                'expect' => false,
            ],
            '現在のパスワードと異なる' => [
                'data' => [
                    'currentPassword' => 'wrong_password',
                    'newPassword' => 'new_password',
                ],
                'errors' => [
                    'currentPassword' => ['The password is incorrect.'],
                ],
                'expect' => false,
            ],
        ];
    }
}
