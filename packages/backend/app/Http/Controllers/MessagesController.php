<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListMessageRequest;
use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;
use App\OpenApi\Parameters\ListMessagesParameters;
use App\OpenApi\RequestBodies\MessageCreateRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\MessageCreateResponse;
use App\OpenApi\Responses\MessageListResponse;
use App\OpenApi\Responses\UnauthorizedRequestResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class MessagesController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;

    /**
     * メッセージ投稿用エンドポイント
     *
     * @param  MessageCreateRequest  $request
     *
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: MessageCreateRequestBody::class)]
    #[OpenApi\Response(factory: MessageCreateResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function createMessage(MessageCreateRequest $request): Response
    {
        $user = $request->user();
        assert($user !== null);

        $validated = $request->validated();

        $message = new Message();
        $message->id = Uuid::uuid7()->toString();
        $message->user_id = $user->id;
        $message->body = $validated['body'];
        $message->save();

        return response(null, 201);
    }

    /**
     * メッセージ取得用エンドポイント
     *
     * @param  ListMessageRequest  $request
     *
     * @return JsonResponse|Response
     */
    #[OpenApi\Operation]
    #[OpenApi\Parameters(factory: ListMessagesParameters::class)]
    #[OpenApi\Response(factory: MessageListResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function listMessage(ListMessageRequest $request): JsonResponse|Response
    {
        $user = Auth::user();
        assert($user !== null);

        $validated = $request->validated();

        $lastMessageId = $validated['lastMessageId'] ?? null;
        $userId = $user->id;

        $perPage = $validated['perPage'] ?? self::DEFAULT_PER_PAGE;

        $messages = Message::with('favorites')
            ->withCount(['favorites' => function (Builder $query) use ($userId) {
                $query->where('user_id', $userId);
            },
            ])
            ->with('user')
            ->when($lastMessageId, function (Builder $query) use ($lastMessageId) {
                $query->where('id', '<', $lastMessageId);
            })
            ->orderBy('id', 'desc')
            ->take($perPage)
            ->get();

        $response = $messages->map(fn (Message $message): array => [
            'id' => $message->id,
            'created_by' => $message->user->name,
            'body' => $message->body,
            'created_at' => $message->created_at,
            'isFavorite' => $message->favorites->isNotEmpty(),
            'favoritesCount' => $message->favorites->count(),
        ]);

        return response()->json($response);
    }
}
