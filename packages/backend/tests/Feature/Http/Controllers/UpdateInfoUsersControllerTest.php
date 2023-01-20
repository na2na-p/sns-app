<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UpdateInfoUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザ情報更新が正しく行えるかテスト
     *
     * @return void
     */
    public function testUpdateUser(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $oldName = $user->name;
        $oldEmail = $user->email;

        $name = 'hoge';
        $email = 'fuga@example.com';

        $response = $this->put('/api/v1/users/me', [
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertStatus(ResponseAlias::HTTP_OK);

        $updatedUser = User::first();
        $this->assertEquals($name, $updatedUser->name);
        $this->assertEquals($email, $updatedUser->email);

        $this->assertNotEquals($oldName, $updatedUser->name);
        $this->assertNotEquals($oldEmail, $updatedUser->email);
    }
}
