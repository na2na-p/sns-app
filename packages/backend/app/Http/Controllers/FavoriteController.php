<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録用エンドポイント
     *
     * @param  Request  $request
     * @param  string  $messageId
     * @return Response
     */
    public function addFavorite(Request $request, string $messageId): Response
    {
        $user = $request->user();
        assert($user !== null);
        $userId = $user->id;

        $message = Message::where('id', $messageId)->first();

        if ($message === null) {
            return response([
                'message' => 'Message Not Found',
            ], 404);
        }

        $isAlreadyFavorite = $message->favorites->contains(function (Favorite $favorite) use ($userId) {
            return $favorite->user_id === $userId;
        });

        if ($isAlreadyFavorite) {
            $favorite = $message->favorites->first(function (Favorite $favorite) use ($userId) {
                return $favorite->user_id === $userId;
            });
            assert($favorite !== null);
            $favorite->touch();
            return response(null, 200);
        }

        $favorite = new Favorite();
        $favorite->id = Uuid::uuid7()->toString();
        $favorite->user_id = $userId;
        $favorite->message_id = $messageId;
        $favorite->save();
        return response(null, 200);
    }
}
