<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
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
        if ($request->user() === null) {
            return response([
                'message' => 'Unauthorized',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'isFavorite' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message = Message::find($messageId);
        if ($message === null) {
            return response([
                'message' => 'Message Not Found',
            ], 404);
        }

        if ($request->input('isFavorite')) {
            $uuid = Uuid::uuid7();

            $favorite = new Favorite();
            $favorite->id = $uuid->toString();
            $favorite->user_id = $request->user()->id;
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
