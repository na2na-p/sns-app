<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UsersControllerTest extends TestCase
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
    }

    /**
     * ユーザ登録が正しく動作するか
     *
     * @return void
     */
    public function testSignUp(): void
    {
        $response = $this->post('/api/v1/users', [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => fake()->password(),
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    /**
     * ユーザの名前の文字が極端に大きい場合にバリデーションが正しく動作するか
     *
     * @return void
     *
     * @throws Exception
     */
    public function testEdgeSignUpWithNameLengthOutObBounds(): void
    {
        $response = $this->post('/api/v1/users', [
            'name' => Str::random(random_int(65, 9999)),
            'email' => 'bar@example.com',
            'password' => 'aaaaAAAA',
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    'The name must not be greater than 64 characters.',
                ],
            ],
        ]);
    }

    /**
     * ユーザの名前の文字が極端に大きい場合にバリデーションが正しく動作するか
     *
     * @return void
     *
     * @throws Exception
     */
    public function testEdgeSignUpWithNonEmailType(): void
    {
        $response = $this->post('/api/v1/users', [
            'name' => fake()->name(),
            'email' => Str::random(random_int(1, 255)),
            'password' => 'aaaaAAAA',
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email must be a valid email address.',
                ],
            ],
        ]);
    }

    /**
     * ユーザのメールアドレスが重複している場合にバリデーションが正しく動作するか
     *
     * @return void
     *
     * @throws Exception
     */
    public function testEdgeSignUpWithDuplicateEmail(): void
    {
        $email = fake()->safeEmail();
        User::factory()->create(
            [
                'email' => $email,
            ]
        );
        $response = $this->post('/api/v1/users', [
            'name' => fake()->name(),
            'email' => $email,
            'password' => 'aaaaAAAA',
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email has already been taken.',
                ],
            ],
        ]);
    }

    /**
     * ユーザのパスワードが極端に短い場合にバリデーションが正しく動作するか
     *
     * @return void
     *
     * @throws Exception
     */
    public function testEdgeSignUpWithPasswordLengthOutObBounds(): void
    {
        $response = $this->post('/api/v1/users', [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => Str::random(random_int(1, 7)),
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    'The password must be at least 8 characters.',
                ],
            ],
        ]);
    }

    /**
     * ユーザのパスワードが極端に長い場合にバリデーションが正しく動作するか
     *
     * @return void
     *
     * @throws Exception
     */
    public function testEdgeSignUpWithPasswordLengthOutObBounds2(): void
    {
        $response = $this->post('/api/v1/users', [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => Str::random(random_int(32, 9999)),
        ]);
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    'The password must not be greater than 32 characters.',
                ],
            ],
        ]);
    }
}
