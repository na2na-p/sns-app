<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class AddFavoriteFavoritesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * お気に入り登録できるか
     *
     * @return void
     */
    public function testAddFavorite(): void
    {
        $this->assertDatabaseCount('favorites', 0);

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $message = Message::factory()->create();
        $messageId = $message->id;

        $response = $this->put('/api/v1/messages/'.$messageId.'/favorite');
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertDatabaseCount('favorites', 1);
    }

    /**
     * すでにお気に入り済みの場合、updated_atが更新されるか
     *
     * @return void
     */
    public function testAddFavoriteAlreadyFavorite(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $message = Message::factory()->create();
        $messageId = $message->id;

        $favorite = Favorite::factory()->create([
            'user_id' => $user->id,
            'message_id' => $messageId,
        ]);

        $previousUpdatedAt = $favorite->updated_at;

        sleep(1);
        $response = $this->put('/api/v1/messages/'.$messageId.'/favorite');
        $response->assertStatus(ResponseAlias::HTTP_OK);

        $this->assertDatabaseCount('favorites', 1);

        $currentUpdatedAt = Favorite::first()->updated_at;

        $this->assertNotEquals($previousUpdatedAt, $currentUpdatedAt);
    }

    /**
     * 存在しないメッセージにお気に入りした場合
     *
     * @return void
     */
    public function testAddFavoriteToFictitiousMessage(): void
    {
        $this->assertDatabaseCount('favorites', 0);

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->put('/api/v1/messages/'.'fictitious'.'/favorite');
        $response->assertStatus(ResponseAlias::HTTP_NOT_FOUND);

        $this->assertDatabaseCount('favorites', 0);
    }
}
