<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\OpenApi\RequestBodies\SignupRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\SignupResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class UsersController extends Controller
{
    /**
     * ユーザ登録用エンドポイント
     *
     * @param  SignupRequest  $request
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: SignupRequestBody::class)]
    #[OpenApi\Response(factory: SignupResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    public function signUp(SignupRequest $request): Response
    {
        $validated = $request->validated();

        $uuid = Uuid::uuid7();

        $user = new User();
        $user->id = $uuid->toString();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        $request->session()->regenerate();
        Auth::login($user);

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ], 201);
    }

    /**
     * ログイン済みかどうかの判定用エンドポイント
     *
     * @param  Request  $request
     * @return Response
     */
    public function findUser(Request $request): Response
    {
        $user = $request->user();
        assert($user !== null);

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}