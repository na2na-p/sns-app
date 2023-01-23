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
     *
     * @return void
     */
    public function testListMessage(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

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
    }

    /**
     * lastMessageIdを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testListMessageWithLastMessageId(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

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
    }

    /**
     * perPageを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testListMessageWithPerPage(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 5;
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
    }

    /**
     * lastMessageIdとperPageを利用してメッセージ取得できるか
     *
     * @return void
     */
    public function testListMessageWithLastMessageIdAndPerPage(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $perPage = 5;
        $message = Message::orderBy('id', 'desc')->limit(2)->get();
        $queryLastMessageId = $message->first()->id;
        $responseHeadMessageId = $message->last()->id;

        $response = $this->get('/api/v1/messages?lastMessageId='.$queryLastMessageId.'&perPage='.$perPage);
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

        $response->assertJsonFragment([
            'id' => $responseHeadMessageId,
        ]);
    }

    /**
     * 自分のお気に入り済みのメッセージが含まれる場合にただしくレスポンスできるか
     *
     * @return void
     */
    public function testListMessageWithAlreadyFavorited(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $message = Message::first();
        Favorite::factory()->create([
            'user_id' => $user->id,
            'message_id' => $message->id,
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
            'id' => $message->id,
            'isFavorite' => true,
        ]);
    }

    /**
     * 他人のお気に入り済みのメッセージが含まれる場合にただしくレスポンスできるか
     *
     * @return void
     */
    public function testListMessageWithAlreadyFavoritedByOthers(): void
    {
        Message::factory()->count(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $favoritter = User::factory()->create();

        $message = Message::first();
        Favorite::factory()->create([
            'user_id' => $favoritter->id,
            'message_id' => $message->id,
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
            'id' => $message->id,
            'isFavorite' => false,
        ]);
    }
}
