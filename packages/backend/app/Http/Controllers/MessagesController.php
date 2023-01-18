<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\OpenApi\RequestBodies\MessageCreateRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\MessageCreateResponse;
use App\OpenApi\Responses\MessageListResponse;
use App\OpenApi\Responses\UnauthorizedRequestResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class MessagesController extends Controller
{
    /**
     * メッセージ投稿用エンドポイント
     *
     * @param  Request  $request
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: MessageCreateRequestBody::class)]
    #[OpenApi\Response(factory: MessageCreateResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function messageCreate(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        if ($request->user() === null) {
            return response(null, 401);
        }

        $validator = Validator::make($request->all(), [
            'body' => ['required', 'string', 'max:140'],
        ]);

        if ($validator->fails()) {
            return response(null, 400);
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
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: MessageCreateRequestBody::class)]
    #[OpenApi\Response(factory: MessageListResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function messageList(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        if ($request->user() === null) {
            return response(null, 401);
        }

        $validator = Validator::make($request->all(), [
            'lastMessageId' => ['string'],
            'perPage' => ['integer'],
        ]);

        if ($validator->fails()) {
            return response(null, 400);
        }

        $perPage = $validator->getData()['perPage'] ?? 10;

        $messages = Message::query()
            ->select(['id', 'user_id', 'body', 'created_at'])
            ->where('user_id', $request->user()->id)
            ->when($validator->getData()['lastMessageId'] ?? null, function ($query, $lastMessageId) {
                return $query->where('id', '<', $lastMessageId);
            })
            ->orderByDesc('id')
            ->limit($perPage)
            ->get();

        $messages->each(function ($message) use ($request) {
            $message->isFavorite = $message->favorites()->where('user_id', $request->user()->id)->exists();
            $message->favoritesCount = $message->favorites()->count();
        });

        return response()->json($messages);
    }
}
