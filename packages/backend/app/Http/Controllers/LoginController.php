<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\OpenApi\RequestBodies\LoginRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\LoginResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LoginController extends Controller
{
    /**
     * ログイン用エンドポイント
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: LoginRequestBody::class)]
    #[OpenApi\Response(factory: LoginResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    public function login(LoginRequest $request): Response
    {
        if (Auth::check()) {
            $request->session()->regenerate();
        }

        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return response(null, 200);
        }

        return response([
            'message' => 'Authentication failed',
        ], 403);
    }
}
