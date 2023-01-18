<?php

namespace App\Http\Controllers;

use App\Http\Requests\addFavoriteRequest;
use App\Models\Favorite;
use App\Models\Message;
use Exception;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class FavoriteController extends Controller
{
    /**
     * お気に入り登録用エンドポイント
     *
     * @param  addFavoriteRequest  $request
     * @param  string  $messageId
     * @return Response
     */
    public function addFavorite(addFavoriteRequest $request, string $messageId): Response
    {
        $user = $request->user();
        assert($user !== null);

        $validated = $request->validated();

        $message = Message::find($messageId);
        if ($message === null) {
            return response([
                'message' => 'Message Not Found',
            ], 404);
        }

        if ($validated['isFavorite']) {
            $uuid = Uuid::uuid7();

            $favorite = new Favorite();
            $favorite->id = $uuid->toString();
            $favorite->user_id = $user->id;
            $favorite->message_id = $messageId;

            try {
                $favorite->save();
            } catch (Exception) {
                return response([
                    'message' => 'Already a favorite',
                ], 400);
            }

            return response(null, 200);
        }

        return response([
            'message' => 'Already a favorite',
        ], 400);
    }
}
