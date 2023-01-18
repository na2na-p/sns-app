<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * ユーザ登録用エンドポイント
     *
     * @param  SignupRequest  $request
     * @return Response
     */
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
