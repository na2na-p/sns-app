<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class CreateMessageMessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メッセージ投稿できるか
     *
     * @return void
     */
    public function testMessageCreate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->assertDatabaseCount('messages', 0);
        $body = 'test';

        $response = $this->post('/api/v1/messages', [
            'body' => $body,
        ]);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);

        $this->assertDatabaseCount('messages', 1);
        $user = Message::first();
        $this->assertEquals($body, $user->body);
    }
}
