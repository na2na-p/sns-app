<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use App\OpenApi\Responses\AddFavoriteResponse;
use App\OpenApi\Responses\NotFoundResponse;
use App\OpenApi\Responses\UnauthorizedRequestResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class FavoriteController extends Controller
{
    /**
     * お気に入り登録用エンドポイント
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: AddFavoriteResponse::class)]
    #[OpenApi\Response(factory: NotFoundResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function addFavorite(string $messageId): Response
    {
        $user = Auth::user();
        assert($user !== null);
        $userId = $user->id;

        $message = Message::where('id', $messageId)->first();

        if ($message === null) {
            return response([
                'message' => 'Message Not Found',
            ], 404);
        }

        Favorite::updateOrCreate([
            'user_id' => $userId,
            'message_id' => $messageId,
        ], [
            'id' => Uuid::uuid7()->toString(),
            'user_id' => $userId,
            'message_id' => $messageId,
        ]);

        return response(null, 200);
    }
}
