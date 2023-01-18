<?php

namespace App\Http\Controllers;

use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\LogoutResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LogoutController extends Controller
{
    /**
     * ログアウト用エンドポイント
     *
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: LogoutResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    public function logout(): Response
    {
        if (! Auth::check()) {
            return response([
                'message' => 'Not logged in',
            ], 400);
        }

        Auth::logout();

        return response(null, 200);
    }
}
