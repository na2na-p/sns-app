<?php

namespace App\Http\Controllers;

use App\OpenApi\RequestBodies\LoginRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\LoginResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LoginController extends Controller
{
    /**
     * ログイン用エンドポイント
     *
     * @param  Request  $request
     * @return Response|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: LoginRequestBody::class)]
    #[OpenApi\Response(factory: LoginResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    public function login(Request $request): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Authentication failed',
            ], 400);
        }

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();

            if (! Auth::user()) {
                return response([
                    'message' => 'Internal Server Error',
                ], 500);
            }

            return response([
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ], 200);
        }

        return response([
            'message' => 'Authentication failed',
        ], 400);
    }
}
