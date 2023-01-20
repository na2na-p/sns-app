<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\OpenApi\RequestBodies\SignupRequestBody;
use App\OpenApi\RequestBodies\UpdateUserPasswordRequestBody;
use App\OpenApi\RequestBodies\UpdateUserRequestBody;
use App\OpenApi\Responses\BadRequestResponse;
use App\OpenApi\Responses\FindUserResponse;
use App\OpenApi\Responses\SignupResponse;
use App\OpenApi\Responses\UnauthorizedRequestResponse;
use App\OpenApi\Responses\UpdateUserPasswordResponse;
use App\OpenApi\Responses\UpdateUserResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UsersController extends Controller
{
    /**
     * ユーザ登録用エンドポイント
     *
     * @param  SignupRequest  $request
     *
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
     *
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: FindUserResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function findUser(Request $request): Response
    {
        $user = Auth::user();
        assert($user !== null);

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * ユーザ情報更新用エンドポイント
     *
     * @param  UpdateUserRequest  $request
     *
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: UpdateUserRequestBody::class)]
    #[OpenApi\Response(factory: UpdateUserResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function updateUser(UpdateUserRequest $request): Response
    {
        $user = Auth::user();
        assert($user !== null);

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * パスワード更新用エンドポイント
     *
     * @param  PasswordUpdateRequest  $request
     *
     * @return Response
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: UpdateUserPasswordRequestBody::class)]
    #[OpenApi\Response(factory: UpdateUserPasswordResponse::class)]
    #[OpenApi\Response(factory: BadRequestResponse::class)]
    #[OpenApi\Response(factory: UnauthorizedRequestResponse::class)]
    public function updatePassword(PasswordUpdateRequest $request): Response
    {
        $user = Auth::user();
        assert($user !== null);

        $validated = $request->validated();

        $user->password = Hash::make($validated['newPassword']);
        $user->save();

        return response(null, 200);
    }
}
