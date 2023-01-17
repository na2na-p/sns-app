<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\OpenApi\RequestBodies\MessageCreateRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\MessageCreateResponse;
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
            return response('Unauthorized', 401);
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
}
