<?php

namespace tests\Unit\Requests;

use App\Http\Requests\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
     * バリデーションテスト(異常系)
     *
     * @dataProvider signupUsersArgsValidationInvalidDataProvider
     *
     * @param  array  $data
     * @param  array  $errors
     * @return void
     */
    public function testSignupUsersArgsValidation(array $data, array $errors): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * 異常系テストに渡すデータ
     */
    public function signupUsersArgsValidationInvalidDataProvider(): array
    {
        return [
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'currentPassword' => ['The current password field is required.'],
                    'newPassword' => ['The new password field is required.'],
                ],
            ],
            '文字数が多すぎる' => [
                'data' => [
                    'currentPassword' => 'password',
                    'newPassword' => str_repeat('a', 33),
                ],
                'errors' => [
                    'newPassword' => ['The new password must not be greater than 32 characters.'],
                ],
            ],
            '現在のパスワードと異なる' => [
                'data' => [
                    'currentPassword' => 'wrong_password',
                    'newPassword' => 'new_password',
                ],
                'errors' => [
                    'currentPassword' => ['The password is incorrect.'],
                ],
            ],
        ];
    }

    /**
     * バリデーションテスト(正常系)
     *
     * @dataProvider signupUsersArgsValidationValidDataProvider
     *
     * @param  array  $data
     * @return void
     */
    public function testSignupUsersArgsValidationValid(array $data): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(true, $result);
    }

    /**
     * 正常系テストに渡すデータ
     */
    public function signupUsersArgsValidationValidDataProvider(): array
    {
        return [
            '正常系' => [
                'data' => [
                    'currentPassword' => 'password',
                    'newPassword' => 'new-password',
                ],
            ],
        ];
    }
}
