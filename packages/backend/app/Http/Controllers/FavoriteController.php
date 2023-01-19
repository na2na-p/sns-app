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
