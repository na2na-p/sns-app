<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ListMessageMessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Message::factory()->count(10)->create();
    }

    /**
     * メッセージ取得できるか
     *
     * @return void
     */
    public function testMessageCreate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/api/v1/messages');
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(10);
    }

    /**
     * lastMessageIdを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testMessageCreateWithLastMessageId(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

        $response = $this->get('/api/v1/messages?lastMessageId='.$queryLastMessageId);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(9);

        $response->assertJsonFragment([
            'id' => $responseHeadMessageId,
        ]);
    }

    /**
     * perPageを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testMessageCreateWithPerPage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 5;
        $response = $this->get('/api/v1/messages?perPage='.$perPage);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(5);
    }

    /**
     * lastMessageIdとperPageを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testMessageCreateWithLastMessageIdAndPerPage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 5;
        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

        $response = $this->get('/api/v1/messages?lastMessageId='.$queryLastMessageId.'&perPage='.$perPage);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(5);

        $response->assertJsonFragment([
            'id' => $responseHeadMessageId,
        ]);
    }
}
