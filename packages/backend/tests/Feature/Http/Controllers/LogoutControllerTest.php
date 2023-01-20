<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログアウトが正しく動作するか
     *
     * @return void
     */
    public function testLogout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/api/v1/logout');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $this->assertGuest();
    }

    /**
     * ログアウト済みの際に正しいレスポンスを返すか
     *
     * @return void
     */
    public function testLogoutWithAlreadyLoggedOut(): void
    {
        $this->assertGuest();
        $response = $this->post('/api/v1/logout');
        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $this->assertGuest();
    }
}
