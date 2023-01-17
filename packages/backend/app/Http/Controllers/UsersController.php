<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\OpenApi\RequestBodies\SignUpRequestBody;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UsersController extends Controller
{
    /**
     * ユーザ登録用エンドポイント
     *
     * @param Request $request
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    #[OpenApi\RequestBody(factory: SignUpRequestBody::class)]
    public function signUp(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if ($validator->fails()) {
            return response(null, 400);
        }

        $uuid = Uuid::uuid7();

        $user = new User();
        $user->id = $uuid->toString();
        $user->name = $validator->getData()['name'];
        $user->email = $validator->getData()['email'];
        $user->password = Hash::make($validator->getData()['password']);
        $user->save();

        $request->session()->regenerate();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * ログイン済みかどうかの判定用エンドポイント
     *
     * @param Request $request
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    #[OpenApi\Operation]
    public function whoAmI(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        if ($request->user() === null) {
            return response(null, 401);
        }

        return response()->json([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
