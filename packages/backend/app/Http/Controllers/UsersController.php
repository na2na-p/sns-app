<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * ユーザ登録用エンドポイント
     *
     * @param  Request  $request
     * @return Response
     */
    public function signUp(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Validation Error',
            ], 400);
        }

        $uuid = Uuid::uuid7();

        $user = new User();
        $user->id = $uuid->toString();
        $user->name = $validator->getData()['name'];
        $user->email = $validator->getData()['email'];
        $user->password = Hash::make($validator->getData()['password']);
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
    public function whoAmI(Request $request): Response
    {
        if (is_null($request->user())) {
            return response([
                'message' => 'Unauthorized',
            ], 401);
        }

        return response([
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
