<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LogoutController extends Controller
{
    /**
     * ログアウト用エンドポイント
     *
     * @return Response|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    public function logout(): Response|Application|ResponseFactory
    {
        Auth::logout();

        return response(null, 200);
    }
}
