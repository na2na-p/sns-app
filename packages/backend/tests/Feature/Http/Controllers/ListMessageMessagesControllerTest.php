<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ListMessageMessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * メッセージ取得できるか
     */
    public function testListMessage(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $messages = Message::with('user')->orderBy('created_at', 'desc')->paginate(2);

        $messageIdsOderByIdDesc = Message::orderBy('id', 'desc')->pluck('id')->toArray();

        $favoritter = User::factory()->create();
        Favorite::factory()->create([
            'user_id' => $favoritter->id,
            'message_id' => $messages[0]->id,
        ]);

        Favorite::factory()->create([
            'user_id' => $user->id,
            'message_id' => $messages[1]->id,
        ]);

        $response = $this->get('/api/v1/messages');
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(10);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'body',
                'created_by',
                'created_at',
                'favoritesCount',
                'isFavorite',
            ],
        ]);

        $response->assertJsonFragment([
            'id' => $messages[0]->id,
            'body' => $messages[0]->body,
            'created_by' => $messages[0]->user->name,
            'created_at' => $messages[0]->created_at,
            'favoritesCount' => 1,
            'isFavorite' => false,
        ]);

        $response->assertJsonFragment([
            'id' => $messages[1]->id,
            'body' => $messages[1]->body,
            'created_by' => $messages[1]->user->name,
            'created_at' => $messages[1]->created_at,
            'favoritesCount' => 1,
            'isFavorite' => true,
        ]);

        $receivedIdsArray = [];
        foreach ($response->json() as $message) {
            $receivedIdsArray[] = $message['id'];
        }

        $expectedIdsArray = [];
        foreach ($messageIdsOderByIdDesc as $messageId) {
            $expectedIdsArray[] = $messageId;
        }

        $this->assertEquals($receivedIdsArray, $expectedIdsArray);
    }

    /**
     * lastMessageIdを利用してメッセージ取得できるか
     */
    public function testListMessageWithLastMessageId(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

        $expectedResponseMessages = Message::with('user')
            ->where('id', '<', $queryLastMessageId)
            ->orderBy('id', 'desc')
            ->limit(9)
            ->get();

        $response = $this->get('/api/v1/messages?lastMessageId='.$queryLastMessageId);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(9);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'body',
                'created_by',
                'created_at',
                'favoritesCount',
                'isFavorite',
            ],
        ]);

        $response->assertJsonFragment([
            'id' => $responseHeadMessageId,
        ]);

        $receivedIdsArray = [];
        foreach ($response->json() as $message) {
            $receivedIdsArray[] = $message['id'];
        }

        $expectedIdsArray = [];
        foreach ($expectedResponseMessages as $message) {
            $expectedIdsArray[] = $message->id;
        }

        $this->assertEquals($receivedIdsArray, $expectedIdsArray);
    }

    /**
     * perPageを利用してメッセージ取得できるか
     */
    public function testListMessageWithPerPage(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 5;

        $expectedResponseMessages = Message::with('user')->orderBy('id', 'desc')->paginate($perPage);

        $response = $this->get('/api/v1/messages?perPage='.$perPage);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(5);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'body',
                'created_by',
                'created_at',
                'favoritesCount',
                'isFavorite',
            ],
        ]);

        $receivedIdsArray = [];
        foreach ($response->json() as $message) {
            $receivedIdsArray[] = $message['id'];
        }

        $expectedIdsArray = [];
        foreach ($expectedResponseMessages as $message) {
            $expectedIdsArray[] = $message->id;
        }

        $this->assertEquals($receivedIdsArray, $expectedIdsArray);
    }

    /**
     * lastMessageIdとperPageを利用してメッセージ取得できるか
     */
    public function testListMessageWithLastMessageIdAndPerPage(): void
    {
        Message::factory()->count(5)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 3;
        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

        $expectedResponseMessages = Message::with('user')
            ->where('id', '<', $queryLastMessageId)
            ->orderBy('id', 'desc')
            ->limit($perPage)
            ->get();

        $response = $this->get('/api/v1/messages?lastMessageId='.$queryLastMessageId.'&perPage='.$perPage);
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $response->assertJsonCount(3);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'body',
                'created_by',
                'created_at',
                'favoritesCount',
                'isFavorite',
            ],
        ]);

        $response->assertJsonFragment([
            'id' => $responseHeadMessageId,
        ]);

        $receivedIdsArray = [];
        foreach ($response->json() as $message) {
            $receivedIdsArray[] = $message['id'];
        }

        $expectedIdsArray = [];
        foreach ($expectedResponseMessages as $message) {
            $expectedIdsArray[] = $message->id;
        }

        $this->assertEquals($receivedIdsArray, $expectedIdsArray);
    }
}
