<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * ログイン用エンドポイント
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        if (Auth::check()) {
            $request->session()->regenerate();
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Bad request',
            ], 400);
        }

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();

            return response(null, 200);
        }

        return response([
            'message' => 'Authentication failed',
        ], 403);
    }
}
