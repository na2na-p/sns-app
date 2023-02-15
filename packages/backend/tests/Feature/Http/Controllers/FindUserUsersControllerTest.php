<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class FindUserUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインしていない時にただしくレスポンスを返せるか
     */
    public function testAuthMiddlewareAuthFail(): void
    {
        $response = $this->get('/api/v1/users/me');
        $response->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED);
        $response->assertJson([
            'message' => 'Unauthorized',
        ]);
    }

    /**
     * ログイン済みの時にただしくレスポンスを返せるか
     */
    public function testAuthMiddlewareAuthSuccess(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/api/v1/users/me');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
