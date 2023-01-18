<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use App\OpenApi\RequestBodies\FavoriteReverseRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\FavoriteReverseResponse;
use App\OpenApi\Responses\UnauthorizedRequestResponse;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class FavoriteController extends Controller
{
    /**
     * お気に入り登録用エンドポイント
     *
     * @param  Request  $request
     * @param  string  $messageId
     * @return Response|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: FavoriteReverseRequestBody::class)]
    #[OpenApi\Response(factory: FavoriteReverseResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function addFavorite(Request $request, string $messageId): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'isFavorite' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response(null, 400);
        }

        if ($request->user() === null) {
            return response(null, 401);
        }

//        $messageId = $request->route('messageId');

        $message = Message::find($messageId);
        if ($message === null) {
            return response([
                'message' => 'Bad Request',
            ], 400);
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
