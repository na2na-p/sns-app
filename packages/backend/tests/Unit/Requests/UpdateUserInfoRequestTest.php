<?php

namespace tests\Unit\Requests;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateUserInfoRequestTest extends TestCase
{
    use RefreshDatabase;

    protected UpdateUserRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new UpdateUserRequest();
    }

    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(UpdateUserRequest::class, $this->request);
    }

    /**
     * バリデーションテスト
     *
     * @dataProvider updateUserInfoArgsValidationDataProvider
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

        $rules = $this->request->rules();
        $validator = Validator::make($data, $rules);

        $result = $validator->passes();

        $this->assertEquals(false, $result);
        $this->assertEquals($errors, $validator->errors()->toArray());
    }

    /**
     * テストに渡すデータ
     */
    public function updateUserInfoArgsValidationDataProvider(): array
    {
        return [
            'フィールドが空' => [
                'data' => [],
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                ],
            ],
            'メールアドレスがすでに存在する' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'test@example.com',
                ],
                'errors' => [
                    'email' => ['The email has already been taken.'],
                ],
            ],
            'メールアドレスの形式が不正' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'invalid-email',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            'Edge: 実在するがRFC違反メールアドレス' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'ab..cd@example.com',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            'Edge: 実在するがRFC違反メールアドレス2' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'ab[cd@example.com',
                ],
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ],
            ],
            //            'Edge: メールアドレス' => [
            //                'data' => [
            //                    'name' => "test",
            //                    'email' => '”ab..cd”@example.com',
            //                ],
            //                'errors' => []
            //            ],
            '文字数が多すぎる' => [
                'data' => [
                    'name' => str_repeat('a', 65),
                    'email' => str_repeat('a', 244).'@example.com',
                ],
                'errors' => [
                    'name' => ['The name must not be greater than 64 characters.'],
                    'email' => ['The email must not be greater than 255 characters.'],
                ],
            ],
        ];
    }
}
