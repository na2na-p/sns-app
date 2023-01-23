<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインが正しく動作するか
     *
     * @return void
     */
    public function testLogin(): void
    {
        $this->assertGuest();

        $password = 'password';
        User::factory()->create();
        $user = User::first();

        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    /**
     * すでにログインしている場合はセッションを破棄して再ログインさせたか
     *
     * @return void
     */
    public function testReLoginWithoutLogout(): void
    {
        $this->assertGuest();

        $password = 'password';
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $beforeSessionId = session()->getId();

        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(200);
        $this->assertAuthenticated();
        $afterSessionId = session()->getId();

        $this->assertNotEquals($beforeSessionId, $afterSessionId);
    }

    /**
     * IDパスワードが間違っている場合に正しく弾けるか
     *
     * @dataProvider signupUsersArgsValidationDataProvider
     *
     * @param  array  $data
     * @return void
     */
    public function testLoginWithInvalidArgs(array $data): void
    {
        $this->assertGuest();
        User::factory()->create();

        $response = $this->post('/api/v1/login', $data);

        $response->assertStatus(ResponseAlias::HTTP_FORBIDDEN);
        $this->assertGuest();
    }

    /**
     * DataProvider
     */
    public function signupUsersArgsValidationDataProvider(): array
    {
        return [
            'メールアドレスが間違っている' => [
                'data' => [
                    'email' => 'invalid@example.com',
                    'password' => 'password',
                ],
            ],
            'パスワードが間違っている' => [
                'data' => [
                    'email' => 'bar@example.com',
                    'password' => 'invalidPassword',
                ],
            ],
            'どちらも間違っている' => [
                'data' => [
                    'email' => 'invalid@example.com',
                    'password' => 'invalidPassword',
                ],
            ],
        ];
    }
}
