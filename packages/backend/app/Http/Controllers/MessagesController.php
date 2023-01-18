<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\Database\Query\Builder;
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
     * @param Request $request
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
     * @param Request $request
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

        $perPage = $validator->getData()['perPage'] ?? self::DEFAULT_PER_PAGE;

        $messages = Message::query()
            ->select(['id', 'user_id', 'body', 'created_at'])
            ->where('user_id', $request->user()->id)
            ->when(
                $validator->getData()['lastMessageId'] ?? null,
                fn(Builder $query, string $lastMessageId): Builder => $query->where('id', '<', $lastMessageId)
            )
            ->orderByDesc('id')
            ->limit($perPage)
            ->get();

        $messages->each(function (Message $message) use (Request $request) {
            $message->isFavorite = $message->favorites()->where('user_id', $request->user()->id)->exists();
            $message->favoritesCount = $message->favorites()->count();
        });

        return response()->json($messages);
    }
}
