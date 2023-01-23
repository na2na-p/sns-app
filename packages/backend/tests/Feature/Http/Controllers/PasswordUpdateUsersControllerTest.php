<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PasswordUpdateUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * パスワード更新
     *
     * @return void
     */
    public function testPasswordUpdate(): void
    {
        $previousPassword = 'password';
        $newPassword = 'new_password';
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $previousHashedPassword = Hash::make($previousPassword);

        $response = $this->put('/api/v1/users/me/password', [
            'currentPassword' => $previousPassword,
            'newPassword' => $newPassword,
        ]);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $user->refresh();

        $this->assertNotEquals($previousHashedPassword, $user->password);
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
