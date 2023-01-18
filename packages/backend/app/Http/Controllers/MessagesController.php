<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class MessagesController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;

    /**
     * メッセージ投稿用エンドポイント
     *
     * @param  Request  $request
     * @return Response
     */
    public function createMessage(Request $request): Response
    {
        if (is_null($request->user())) {
            return response([
                'message' => 'Internal Server Error',
            ], 500);
        }

        $validator = Validator::make($request->all(), [
            'body' => ['required', 'string', 'max:140'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $message = new Message();
        $message->id = Uuid::uuid7()->toString();
        $message->user_id = $request->user()->id;
        $message->body = $validator->getData()['body'];
        $message->save();

        return response(null, 201);
    }

    /**
     * メッセージ取得用エンドポイント
     *
     * @param  Request  $request
     * @return JsonResponse|Response
     */
    public function listMessage(Request $request): JsonResponse|Response
    {
        if (is_null($request->user())) {
            return response([
                'message' => 'Internal Server Error',
            ], 500);
        }

        $validator = Validator::make($request->all(), [
            'lastMessageId' => ['string'],
            'perPage' => ['integer'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $lastMessageId = $validator->getData()['lastMessageId'] ?? null;
        $userId = $request->user()->id;

        $perPage = $validator->getData()['perPage'] ?? self::DEFAULT_PER_PAGE;

        $messages = Message::with('favorites')
            ->withCount(['favorites' => function (Builder $query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->when($lastMessageId, function (Builder $query) use ($lastMessageId) {
                $query->where('id', '<', $lastMessageId);
            })
            ->orderBy('id', 'desc')
            ->take($perPage)
            ->get();

        $response = $messages->map(fn (Message $message): array => [
            'id' => $message->id,
            'user_id' => $message->user_id,
            'body' => $message->body,
            'created_at' => $message->created_at,
            'isFavorite' => $message->favorites->isNotEmpty(),
            'favoritesCount' => $message->favorites->count(),
        ]);

        return response()->json($response);
    }
}
