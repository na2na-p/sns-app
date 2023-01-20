<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class SignUpUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインしていない時にミドルウェアが正しく動作するか
     *
     * @return void
     */
    public function testAuthMiddleware(): void
    {
        $response = $this->get('/api/v1/users/me');
        $response->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED);
        $response->assertJson([
            'message' => 'Unauthorized',
        ]);
    }

    /**
     * ユーザ登録が正しく動作するか
     * 登録後はログイン状態になるか
     *
     * @return void
     */
    public function testSignUp(): void
    {
        $this->assertDatabaseCount('users', 0);

        $name = 'test';
        $email = 'test@example.com';
        $password = 'password';
        $response = $this->post('/api/v1/users', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);

        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertNotEquals($password, $user->password);
        $this->assertEquals(true, Hash::check($password, $user->password));

        $response = $this->get('/api/v1/users/me');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
        ]);
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
