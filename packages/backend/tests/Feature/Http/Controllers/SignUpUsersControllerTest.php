<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->assertAuthenticated();
    }
}
